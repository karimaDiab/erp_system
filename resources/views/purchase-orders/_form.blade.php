@csrf
@isset($order)
    @method('PUT')
@endisset

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_supplier') }}</label>
        <select name="supplier_id" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
            <option value="">—</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" @selected(old('supplier_id', $order->supplier_id ?? null) == $supplier->id)>{{ $supplier->name }}</option>
            @endforeach
        </select>
        @error('supplier_id') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_order_date') }}</label>
        <input type="date" name="order_date" value="{{ old('order_date', isset($order) ? $order->order_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('order_date') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_status') }}</label>
        <select name="status" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
            @foreach (\App\Models\PurchaseOrder::STATUSES as $status)
                <option value="{{ $status }}" @selected(old('status', $order->status ?? 'draft') === $status)>{{ __('app.status_'.$status) }}</option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_notes') }}</label>
        <textarea name="notes" rows="2"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">{{ old('notes', $order->notes ?? '') }}</textarea>
    </div>
</div>

<div class="mt-8">
    <div class="mb-3 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-700">{{ __('app.line_items') }}</h3>
        <button type="button" id="add-item" class="rounded-lg border border-[#2b2361] px-3 py-1.5 text-xs font-semibold text-[#2b2361] hover:bg-[#2b2361]/5">+ {{ __('app.add_item') }}</button>
    </div>

    @error('items') <p class="mb-2 text-xs text-rose-600">{{ $message }}</p> @enderror

    <div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_product') }}</th>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_quantity') }}</th>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_unit_price') }}</th>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_subtotal') }}</th>
                <th class="px-3 py-2"></th>
            </tr>
        </thead>
        <tbody id="items-body" class="divide-y divide-gray-100">
            @forelse (($order->items ?? []) as $i => $item)
                <tr class="item-row">
                    <td class="px-3 py-2">
                        <select name="items[{{ $i }}][product_id]" class="item-product w-full rounded-lg border border-gray-300 px-2 py-1.5 text-sm" required>
                            <option value="">—</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}" @selected($item->product_id == $product->id)>{{ $product->name }} ({{ $product->sku }}) — {{ __('app.available_stock', ['quantity' => $product->quantity_on_hand, 'unit' => $product->unit]) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-3 py-2">
                        <input type="number" min="1" name="items[{{ $i }}][quantity]" class="item-quantity w-24 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="{{ $item->quantity }}" required>
                    </td>
                    <td class="px-3 py-2">
                        <input type="number" min="0" step="0.01" name="items[{{ $i }}][unit_price]" class="item-price w-28 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="{{ $item->unit_price }}" required>
                    </td>
                    <td class="item-subtotal px-3 py-2 text-gray-600">{{ number_format($item->subtotal, 2) }}</td>
                    <td class="px-3 py-2 text-end">
                        <button type="button" class="remove-item text-sm font-medium text-rose-600 hover:underline">{{ __('app.remove') }}</button>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="mt-3 text-end text-sm font-semibold text-gray-700">{{ __('app.field_total') }}: <span id="order-total">0.00</span></div>
</div>

<template id="item-row-template">
    <tr class="item-row">
        <td class="px-3 py-2">
            <select name="items[__INDEX__][product_id]" class="item-product w-full rounded-lg border border-gray-300 px-2 py-1.5 text-sm" required>
                <option value="">—</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}">{{ $product->name }} ({{ $product->sku }}) — {{ __('app.available_stock', ['quantity' => $product->quantity_on_hand, 'unit' => $product->unit]) }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-3 py-2">
            <input type="number" min="1" name="items[__INDEX__][quantity]" class="item-quantity w-24 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="1" required>
        </td>
        <td class="px-3 py-2">
            <input type="number" min="0" step="0.01" name="items[__INDEX__][unit_price]" class="item-price w-28 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="0" required>
        </td>
        <td class="item-subtotal px-3 py-2 text-gray-600">0.00</td>
        <td class="px-3 py-2 text-end">
            <button type="button" class="remove-item text-sm font-medium text-rose-600 hover:underline">{{ __('app.remove') }}</button>
        </td>
    </tr>
</template>

<div class="mt-8 flex gap-3">
    <button type="submit" class="rounded-lg bg-[#2b2361] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#231c4d]">{{ __('app.save') }}</button>
    <a href="{{ route('purchase-orders.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">{{ __('app.cancel') }}</a>
</div>

<script>
(function () {
    let index = {{ count($order->items ?? []) }};
    const body = document.getElementById('items-body');
    const template = document.getElementById('item-row-template');
    const totalEl = document.getElementById('order-total');

    function recalcRow(row) {
        const qty = parseFloat(row.querySelector('.item-quantity').value) || 0;
        const price = parseFloat(row.querySelector('.item-price').value) || 0;
        row.querySelector('.item-subtotal').textContent = (qty * price).toFixed(2);
    }

    function recalcTotal() {
        let total = 0;
        body.querySelectorAll('.item-row').forEach(function (row) {
            const qty = parseFloat(row.querySelector('.item-quantity').value) || 0;
            const price = parseFloat(row.querySelector('.item-price').value) || 0;
            total += qty * price;
        });
        totalEl.textContent = total.toFixed(2);
    }

    function recalcAll() {
        body.querySelectorAll('.item-row').forEach(recalcRow);
        recalcTotal();
    }

    document.getElementById('add-item').addEventListener('click', function () {
        const html = template.innerHTML.replaceAll('__INDEX__', index++);
        body.insertAdjacentHTML('beforeend', html);
        recalcAll();
    });

    body.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.item-row').remove();
            recalcTotal();
        }
    });

    body.addEventListener('input', function (e) {
        if (e.target.classList.contains('item-quantity') || e.target.classList.contains('item-price')) {
            recalcRow(e.target.closest('.item-row'));
            recalcTotal();
        }
    });

    body.addEventListener('change', function (e) {
        if (e.target.classList.contains('item-product')) {
            const row = e.target.closest('.item-row');
            const option = e.target.selectedOptions[0];
            const priceInput = row.querySelector('.item-price');
            if (option && option.dataset.price !== undefined) {
                priceInput.value = option.dataset.price;
            }
            recalcRow(row);
            recalcTotal();
        }
    });

    recalcAll();
})();
</script>
