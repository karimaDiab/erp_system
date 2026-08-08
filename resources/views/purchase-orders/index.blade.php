<x-app-layout :title="__('app.nav_purchase_orders')">
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-gray-500">{{ __('app.purchase_orders_intro') }}</p>
        <a href="{{ route('purchase-orders.create') }}" class="rounded-lg bg-[#2b2361] px-4 py-2 text-sm font-semibold text-white hover:bg-[#231c4d]">
            + {{ __('app.add_new') }}
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_order_number') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_supplier') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_order_date') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_status') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_total') }}</th>
                    <th class="px-6 py-3 text-end font-semibold text-gray-500">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $order->order_number }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $order->supplier->name }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $order->order_date->format('Y-m-d') }}</td>
                        <td class="px-6 py-3">
                            <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">{{ __('app.status_'.$order->status) }}</span>
                        </td>
                        <td class="px-6 py-3 text-gray-500">{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-3 text-end">
                            <a href="{{ route('purchase-orders.edit', $order) }}" class="font-medium text-[#2b2361] hover:underline">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('purchase-orders.destroy', $order) }}" class="inline" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
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

    <div class="mt-4">{{ $orders->links() }}</div>
</x-app-layout>
