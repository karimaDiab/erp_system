<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductionOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        });

        return redirect()->route('production-orders.index')->with('status', __('app.saved'));
    }

    public function edit(ProductionOrder $productionOrder): View
    {
        $productionOrder->load('materials');

        return view('production-orders.edit', [
            'order' => $productionOrder,
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, ProductionOrder $productionOrder): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $productionOrder) {
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
        });

        return redirect()->route('production-orders.index')->with('status', __('app.saved'));
    }

    public function destroy(ProductionOrder $productionOrder): RedirectResponse
    {
        $productionOrder->delete();

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
