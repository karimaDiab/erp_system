<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesOrderController extends Controller
{
    public function index(): View
    {
        return view('sales-orders.index', [
            'orders' => SalesOrder::with('customer')->latest('order_date')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('sales-orders.create', [
            'customers' => Customer::orderBy('name')->get(),
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $order = SalesOrder::create([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $this->syncItems($order, $validated['items']);
        });

        return redirect()->route('sales-orders.index')->with('status', __('app.saved'));
    }

    public function edit(SalesOrder $salesOrder): View
    {
        $salesOrder->load('items');

        return view('sales-orders.edit', [
            'order' => $salesOrder,
            'customers' => Customer::orderBy('name')->get(),
            'products' => Product::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, SalesOrder $salesOrder): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $salesOrder) {
            $salesOrder->update([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            $salesOrder->items()->delete();
            $this->syncItems($salesOrder, $validated['items']);
        });

        return redirect()->route('sales-orders.index')->with('status', __('app.saved'));
    }

    public function destroy(SalesOrder $salesOrder): RedirectResponse
    {
        $salesOrder->delete();

        return redirect()->route('sales-orders.index')->with('status', __('app.deleted'));
    }

    private function syncItems(SalesOrder $order, array $items): void
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

    private function validated(Request $request): array
    {
        return $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'order_date' => ['required', 'date'],
            'status' => ['required', 'in:'.implode(',', SalesOrder::STATUSES)],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
