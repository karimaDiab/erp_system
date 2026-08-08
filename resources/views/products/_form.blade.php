@csrf
@isset($product)
    @method('PUT')
@endisset

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_name') }}</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_sku') }}</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('sku') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_description') }}</label>
        <textarea name="description" rows="3"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_unit') }}</label>
        <input type="text" name="unit" value="{{ old('unit', $product->unit ?? 'pcs') }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('unit') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_unit_price') }}</label>
        <input type="number" step="0.01" min="0" name="unit_price" value="{{ old('unit_price', $product->unit_price ?? 0) }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('unit_price') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_quantity_on_hand') }}</label>
        <input type="number" min="0" name="quantity_on_hand" value="{{ old('quantity_on_hand', $product->quantity_on_hand ?? 0) }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2b2361] focus:ring-[#2b2361]">
        @error('quantity_on_hand') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))
            class="rounded border-gray-300 text-[#2b2361] focus:ring-[#2b2361]">
        <label for="is_active" class="text-sm font-medium text-gray-700">{{ __('app.active') }}</label>
    </div>
</div>

<div class="mt-8 flex gap-3">
    <button type="submit" class="rounded-lg bg-[#2b2361] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#231c4d]">{{ __('app.save') }}</button>
    <a href="{{ route('products.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">{{ __('app.cancel') }}</a>
</div>
