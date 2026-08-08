<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    public function index(): View
    {
        return view('purchase-orders.index', [
            'orders' => PurchaseOrder::with('supplier')->latest('order_date')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('purchase-orders.create', [
            'suppliers' => Supplier::orderBy('name')->get(),
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $order = PurchaseOrder::create([
                'supplier_id' => $validated['supplier_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $this->syncItems($order, $validated['items']);

            if (in_array($validated['status'], PurchaseOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->addStock($validated['items']);
            }
        });

        return redirect()->route('purchase-orders.index')->with('status', __('app.saved'));
    }

    public function edit(PurchaseOrder $purchaseOrder): View
    {
        $purchaseOrder->load('items');

        return view('purchase-orders.edit', [
            'order' => $purchaseOrder,
            'suppliers' => Supplier::orderBy('name')->get(),
            'products' => Product::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $purchaseOrder) {
            $previousStatus = $purchaseOrder->status;
            $previousItems = $purchaseOrder->items()->get(['product_id', 'quantity'])->toArray();

            if (in_array($previousStatus, PurchaseOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->removeStock($previousItems);
            }

            $purchaseOrder->update([
                'supplier_id' => $validated['supplier_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $purchaseOrder->items()->delete();
            $this->syncItems($purchaseOrder, $validated['items']);

            if (in_array($validated['status'], PurchaseOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->addStock($validated['items']);
            }
        });

        return redirect()->route('purchase-orders.index')->with('status', __('app.saved'));
    }

    public function destroy(PurchaseOrder $purchaseOrder): RedirectResponse
    {
        DB::transaction(function () use ($purchaseOrder) {
            if (in_array($purchaseOrder->status, PurchaseOrder::STOCK_AFFECTING_STATUSES, true)) {
                $this->removeStock($purchaseOrder->items()->get(['product_id', 'quantity'])->toArray());
            }

            $purchaseOrder->delete();
        });

        return redirect()->route('purchase-orders.index')->with('status', __('app.deleted'));
    }

    private function syncItems(PurchaseOrder $order, array $items): void
    {
        $total = 0;

        foreach ($items as $item) {
            $subtotal = $item['quantity'] * $item['unit_price'];
            $total += $subtotal;

            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total_amount' => $total]);
    }

    /**
     * Receiving stock has no upper bound to validate against, unlike selling it.
     */
    private function addStock(array $items): void
    {
        foreach ($this->mergeQuantitiesByProduct($items) as $productId => $quantity) {
            Product::whereKey($productId)->increment('quantity_on_hand', $quantity);
        }
    }

    private function removeStock(array $items): void
    {
        foreach ($this->mergeQuantitiesByProduct($items) as $productId => $quantity) {
            Product::whereKey($productId)->decrement('quantity_on_hand', $quantity);
        }
    }

    private function mergeQuantitiesByProduct(array $items): array
    {
        $merged = [];

        foreach ($items as $item) {
            $merged[$item['product_id']] = ($merged[$item['product_id']] ?? 0) + $item['quantity'];
        }

        return $merged;
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'order_date' => ['required', 'date'],
            'status' => ['required', 'in:'.implode(',', PurchaseOrder::STATUSES)],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
