<x-app-layout :title="__('app.nav_dashboard')">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_products') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</div>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_sales_orders') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\SalesOrder::count() }}</div>
            <a href="{{ route('sales-orders.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_purchase_orders') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\PurchaseOrder::count() }}</div>
            <a href="{{ route('purchase-orders.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_production_orders') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\ProductionOrder::count() }}</div>
            <a href="{{ route('production-orders.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_customers') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\Customer::count() }}</div>
            <a href="{{ route('customers.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <div class="text-sm font-medium text-gray-500">{{ __('app.nav_suppliers') }}</div>
            <div class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\Supplier::count() }}</div>
            <a href="{{ route('suppliers.index') }}" class="mt-4 inline-block text-sm font-semibold text-[#2b2361] hover:underline">{{ __('app.view_all') }}</a>
        </div>
    </div>
</x-app-layout>
