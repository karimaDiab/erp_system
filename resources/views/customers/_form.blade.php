@csrf
@isset($customer)
    @method('PUT')
@endisset

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_name') }}</label>
        <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" required
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#3A306F] focus:ring-[#3A306F]">
        @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_email') }}</label>
        <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#3A306F] focus:ring-[#3A306F]">
        @error('email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#3A306F] focus:ring-[#3A306F]">
        @error('phone') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="sm:col-span-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700">{{ __('app.field_address') }}</label>
        <textarea name="address" rows="3"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#3A306F] focus:ring-[#3A306F]">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 flex gap-3">
    <button type="submit" class="rounded-lg bg-[#3A306F] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#2f2759]">{{ __('app.save') }}</button>
    <a href="{{ route('customers.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">{{ __('app.cancel') }}</a>
</div>
