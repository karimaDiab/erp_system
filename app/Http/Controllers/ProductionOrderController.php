<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductionOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProductionOrderController extends Controller
{
    public function index(): View
    {
        return view('production-orders.index', [
            'orders' => ProductionOrder::with('product')->latest('start_date')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('production-orders.create', [
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $order = ProductionOrder::create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'status' => $validated['status'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $this->syncMaterials($order, $validated['materials'] ?? []);

            if (in_array($validated['status'], ProductionOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->applyCompletion($validated['product_id'], $validated['quantity'], $validated['materials'] ?? []);
            }
        });

        return redirect()->route('production-orders.index')->with('status', __('app.saved'));
    }

    public function edit(ProductionOrder $productionOrder): View
    {
        $productionOrder->load('materials');

        return view('production-orders.edit', [
            'order' => $productionOrder,
            'products' => Product::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, ProductionOrder $productionOrder): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $productionOrder) {
            $wasCompleted = in_array($productionOrder->status, ProductionOrder::STOCK_AFFECTING_STATUSES, true);

            if ($wasCompleted) {
                $this->reverseCompletion(
                    $productionOrder->product_id,
                    $productionOrder->quantity,
                    $productionOrder->materials()->get(['product_id', 'quantity_required'])->toArray()
                );
            }

            $productionOrder->update([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'status' => $validated['status'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $productionOrder->materials()->delete();
            $this->syncMaterials($productionOrder, $validated['materials'] ?? []);

            if (in_array($validated['status'], ProductionOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->applyCompletion($validated['product_id'], $validated['quantity'], $validated['materials'] ?? []);
            }
        });

        return redirect()->route('production-orders.index')->with('status', __('app.saved'));
    }

    public function destroy(ProductionOrder $productionOrder): RedirectResponse
    {
        DB::transaction(function () use ($productionOrder) {
            if (in_array($productionOrder->status, ProductionOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->reverseCompletion(
                    $productionOrder->product_id,
                    $productionOrder->quantity,
                    $productionOrder->materials()->get(['product_id', 'quantity_required'])->toArray()
                );
            }

            $productionOrder->delete();
        });

        return redirect()->route('production-orders.index')->with('status', __('app.deleted'));
    }

    private function syncMaterials(ProductionOrder $order, array $materials): void
    {
        foreach ($materials as $material) {
            $order->materials()->create([
                'product_id' => $material['product_id'],
                'quantity_required' => $material['quantity_required'],
            ]);
        }
    }

    /**
     * Consume raw materials and add the finished good to stock, failing with a
     * validation error if any material does not have enough quantity on hand.
     */
    private function applyCompletion(int $productId, int $quantity, array $materials): void
    {
        $merged = $this->mergeQuantitiesByProduct($materials, 'quantity_required');

        if ($merged !== []) {
            $stock = Product::whereIn('id', array_keys($merged))->lockForUpdate()->get()->keyBy('id');

            foreach ($merged as $materialProductId => $required) {
                $material = $stock->get($materialProductId);

                if (! $material || $material->quantity_on_hand < $required) {
                    throw ValidationException::withMessages([
                        'materials' => __('app.insufficient_stock', [
                            'product' => $material->name ?? $materialProductId,
                            'available' => $material->quantity_on_hand ?? 0,
                        ]),
                    ]);
                }
            }

            foreach ($merged as $materialProductId => $required) {
                Product::whereKey($materialProductId)->decrement('quantity_on_hand', $required);
            }
        }

        Product::whereKey($productId)->increment('quantity_on_hand', $quantity);
    }

    private function reverseCompletion(int $productId, int $quantity, array $materials): void
    {
        foreach ($this->mergeQuantitiesByProduct($materials, 'quantity_required') as $materialProductId => $required) {
            Product::whereKey($materialProductId)->increment('quantity_on_hand', $required);
        }

        Product::whereKey($productId)->decrement('quantity_on_hand', $quantity);
    }

    private function mergeQuantitiesByProduct(array $materials, string $quantityKey): array
    {
        $merged = [];

        foreach ($materials as $material) {
            $merged[$material['product_id']] = ($merged[$material['product_id']] ?? 0) + $material[$quantityKey];
        }

        return $merged;
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:'.implode(',', ProductionOrder::STATUSES)],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'notes' => ['nullable', 'string'],
            'materials' => ['nullable', 'array'],
            'materials.*.product_id' => ['required', 'exists:products,id'],
            'materials.*.quantity_required' => ['required', 'integer', 'min:1'],
        ]);
    }
}
