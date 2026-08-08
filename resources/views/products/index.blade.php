<x-app-layout :title="__('app.nav_products')">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ __('app.products_intro') }}</p>
        <a href="{{ route('products.create') }}" class="rounded-lg bg-[#2b2361] px-4 py-2 text-sm font-semibold text-white hover:bg-[#231c4d]">
            + {{ __('app.add_new') }}
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_name') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_sku') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_unit_price') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_quantity_on_hand') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_status') }}</th>
                    <th class="px-6 py-3 text-end font-semibold text-gray-500">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $product->sku }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ number_format($product->unit_price, 2) }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $product->quantity_on_hand }} {{ $product->unit }}</td>
                        <td class="px-6 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $product->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->is_active ? __('app.active') : __('app.inactive') }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-end">
                            <a href="{{ route('products.edit', $product) }}" class="font-medium text-[#2b2361] hover:underline">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-3 font-medium text-rose-600 hover:underline">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">{{ __('app.no_records') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</x-app-layout>
