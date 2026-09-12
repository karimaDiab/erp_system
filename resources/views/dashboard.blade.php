<x-app-layout :title="__('app.nav_dashboard')">
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-indigo-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8l-9-5-9 5 9 5 9-5z"></path><path d="M3 8v8l9 5 9-5V8"></path><path d="M12 13v8"></path></svg>
                    </div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 transition hover:text-indigo-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\Product::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_products') }}</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-blue-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.5 3h2l2.7 12.4a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21.5 7H6"></path></svg>
                    </div>
                    <a href="{{ route('sales-orders.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 transition hover:text-blue-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\SalesOrder::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_sales_orders') }}</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-amber-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-amber-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500 text-white shadow-lg shadow-amber-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2l1.5 4h9L18 2"></path><path d="M3.5 6h17l-1.4 13a2 2 0 0 1-2 1.8H6.9a2 2 0 0 1-2-1.8L3.5 6z"></path><path d="M9 10v3"></path><path d="M15 10v3"></path></svg>
                    </div>
                    <a href="{{ route('purchase-orders.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 transition hover:text-amber-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\PurchaseOrder::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_purchase_orders') }}</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-violet-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-violet-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-600 text-white shadow-lg shadow-violet-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    </div>
                    <a href="{{ route('production-orders.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-violet-600 transition hover:text-violet-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\ProductionOrder::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_production_orders') }}</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-emerald-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 transition hover:text-emerald-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\Customer::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_customers') }}</div>
            </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition duration-200 hover:-translate-y-1 hover:shadow-lg hover:shadow-rose-100">
            <div class="absolute -top-6 -end-6 h-28 w-28 rounded-full bg-rose-50 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-600 text-white shadow-lg shadow-rose-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="7" width="15" height="12" rx="1"></rect><path d="M16 11h3.5l3.5 4v4h-7v-8z"></path><circle cx="6.5" cy="21" r="1.75"></circle><circle cx="18" cy="21" r="1.75"></circle></svg>
                    </div>
                    <a href="{{ route('suppliers.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 transition hover:text-rose-800">
                        {{ __('app.view_all') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rtl:-scale-x-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M13 6l6 6-6 6"></path></svg>
                    </a>
                </div>
                <div class="mt-6 text-3xl font-bold tracking-tight text-gray-900">{{ \App\Models\Supplier::count() }}</div>
                <div class="mt-1 text-sm font-medium text-gray-500">{{ __('app.nav_suppliers') }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
