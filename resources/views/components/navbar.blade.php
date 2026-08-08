<nav class="flex-1 space-y-6 px-4">
    <div>
        <a href="{{ route('dashboard') }}"
            class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_dashboard') }}
        </a>
    </div>

    <div>
        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">
            {{ __('app.nav_catalog') }}</div>
        <a href="{{ route('products.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('products.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_products') }}
        </a>
    </div>

    <div>
        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">
            {{ __('app.nav_sales') }}</div>
        <a href="{{ route('customers.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('customers.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_customers') }}
        </a>
        <a href="{{ route('sales-orders.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('sales-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_sales_orders') }}
        </a>
    </div>

    <div>
        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">
            {{ __('app.nav_procurement') }}</div>
        <a href="{{ route('suppliers.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('suppliers.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_suppliers') }}
        </a>
        <a href="{{ route('purchase-orders.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('purchase-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_purchase_orders') }}
        </a>
    </div>

    <div>
        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">
            {{ __('app.nav_production') }}</div>
        <a href="{{ route('production-orders.index') }}"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('production-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
            {{ __('app.nav_production_orders') }}
        </a>
    </div>
</nav>
