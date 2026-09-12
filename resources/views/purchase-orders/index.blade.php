@php
$statusColors = [
    'draft' => 'bg-gray-100 text-gray-600',
    'ordered' => 'bg-blue-50 text-blue-700',
    'received' => 'bg-emerald-50 text-emerald-700',
    'cancelled' => 'bg-rose-50 text-rose-700',
];
$statusDots = [
    'draft' => 'bg-gray-400',
    'ordered' => 'bg-blue-500',
    'received' => 'bg-emerald-500',
    'cancelled' => 'bg-rose-500',
];
@endphp
<x-app-layout :title="__('app.nav_purchase_orders')">
    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm ring-1 ring-gray-900/5">
        <div class="flex flex-col gap-4 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2l1.5 4h9L18 2"></path><path d="M3.5 6h17l-1.4 13a2 2 0 0 1-2 1.8H6.9a2 2 0 0 1-2-1.8L3.5 6z"></path><path d="M9 10v3"></path><path d="M15 10v3"></path></svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-900">{{ __('app.nav_purchase_orders') }}</h2>
                    <p class="text-sm text-gray-500">{{ __('app.purchase_orders_intro') }}</p>
                </div>
            </div>
            <a href="{{ route('purchase-orders.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-[#2b2361] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#231c4d]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"></path><path d="M5 12h14"></path></svg>
                {{ __('app.add_new') }}
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="px-6 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.field_order_number') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.field_supplier') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.field_order_date') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.field_status') }}</th>
                        <th class="px-6 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.field_total') }}</th>
                        <th class="px-6 py-3 text-end text-xs font-semibold uppercase tracking-wider text-gray-500">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($orders as $order)
                        <tr class="transition-colors hover:bg-gray-50/80">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->supplier->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->order_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusDots[$order->status] ?? 'bg-gray-400' }}"></span>
                                    {{ __('app.status_'.$order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('purchase-orders.edit', $order) }}" title="{{ __('app.edit') }}" class="rounded-lg p-2 text-gray-400 transition hover:bg-amber-50 hover:text-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    </a>
                                    <form method="POST" action="{{ route('purchase-orders.destroy', $order) }}" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="{{ __('app.delete') }}" class="rounded-lg p-2 text-gray-400 transition hover:bg-rose-50 hover:text-rose-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2l1.5 4h9L18 2"></path><path d="M3.5 6h17l-1.4 13a2 2 0 0 1-2 1.8H6.9a2 2 0 0 1-2-1.8L3.5 6z"></path><path d="M9 10v3"></path><path d="M15 10v3"></path></svg>
                                    <p class="text-sm font-medium">{{ __('app.no_records') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">{{ $orders->links() }}</div>
</x-app-layout>
