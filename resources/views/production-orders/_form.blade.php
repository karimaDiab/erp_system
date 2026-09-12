@csrf
@isset($order)
    @method('PUT')
@endisset

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_product') }}</label>
        <select name="product_id" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
            <option value="">—</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" @selected(old('product_id', $order->product_id ?? null) == $product->id)>{{ $product->name }} ({{ $product->sku }})</option>
            @endforeach
        </select>
        @error('product_id') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_quantity') }}</label>
        <input type="number" min="1" name="quantity" value="{{ old('quantity', $order->quantity ?? 1) }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('quantity') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_status') }}</label>
        <select name="status" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
            @foreach (\App\Models\ProductionOrder::STATUSES as $status)
                <option value="{{ $status }}" @selected(old('status', $order->status ?? 'planned') === $status)>{{ __('app.status_'.$status) }}</option>
            @endforeach
        </select>
        @error('status') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div></div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_start_date') }}</label>
        <input type="date" name="start_date" value="{{ old('start_date', isset($order) ? $order->start_date?->format('Y-m-d') : '') }}"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('start_date') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_end_date') }}</label>
        <input type="date" name="end_date" value="{{ old('end_date', isset($order) ? $order->end_date?->format('Y-m-d') : '') }}"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('end_date') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_notes') }}</label>
        <textarea name="notes" rows="2"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">{{ old('notes', $order->notes ?? '') }}</textarea>
    </div>
</div>

<div class="mt-8">
    <div class="mb-3 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-700">{{ __('app.materials') }}</h3>
        <button type="button" id="add-item" class="rounded-lg border border-[#2b2361] px-3 py-1.5 text-xs font-semibold text-[#2b2361] hover:bg-[#2b2361]/5">+ {{ __('app.add_item') }}</button>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full overflow-hidden text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_product') }}</th>
                <th class="px-3 py-2 text-start font-medium text-gray-500">{{ __('app.field_quantity_required') }}</th>
                <th class="px-3 py-2"></th>
            </tr>
        </thead>
        <tbody id="items-body" class="divide-y divide-gray-100">
            @forelse (($order->materials ?? []) as $i => $material)
                <tr class="item-row">
                    <td class="px-3 py-2">
                        <select name="materials[{{ $i }}][product_id]" class="w-full min-w-[14rem] rounded-lg border border-gray-300 px-2 py-1.5 text-sm" required>
                            <option value="">—</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected($material->product_id == $product->id)>{{ $product->name }} ({{ $product->sku }}) — {{ __('app.available_stock', ['quantity' => $product->quantity_on_hand, 'unit' => $product->unit]) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-3 py-2">
                        <input type="number" min="1" name="materials[{{ $i }}][quantity_required]" class="w-24 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="{{ $material->quantity_required }}" required>
                    </td>
                    <td class="px-3 py-2 text-end">
                        <button type="button" class="remove-item text-sm font-medium text-rose-600 hover:underline">{{ __('app.remove') }}</button>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    </div>
</div>

<template id="item-row-template">
    <tr class="item-row">
        <td class="px-3 py-2">
            <select name="materials[__INDEX__][product_id]" class="w-full min-w-[14rem] rounded-lg border border-gray-300 px-2 py-1.5 text-sm" required>
                <option value="">—</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }}) — {{ __('app.available_stock', ['quantity' => $product->quantity_on_hand, 'unit' => $product->unit]) }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-3 py-2">
            <input type="number" min="1" name="materials[__INDEX__][quantity_required]" class="w-24 rounded-lg border border-gray-300 px-2 py-1.5 text-sm" value="1" required>
        </td>
        <td class="px-3 py-2 text-end">
            <button type="button" class="remove-item text-sm font-medium text-rose-600 hover:underline">{{ __('app.remove') }}</button>
        </td>
    </tr>
</template>

<div class="mt-8 flex gap-3">
    <button type="submit" class="rounded-lg bg-[#2b2361] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#231c4d]">{{ __('app.save') }}</button>
    <a href="{{ route('production-orders.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">{{ __('app.cancel') }}</a>
</div>

<script>
(function () {
    let index = {{ count($order->materials ?? []) }};
    const body = document.getElementById('items-body');
    const template = document.getElementById('item-row-template');

    document.getElementById('add-item').addEventListener('click', function () {
        const html = template.innerHTML.replaceAll('__INDEX__', index++);
        body.insertAdjacentHTML('beforeend', html);
    });

    body.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.item-row').remove();
        }
    });
})();
</script>
