<div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

<aside id="app-sidebar"
    class="fixed inset-y-0 start-0 z-40 flex w-64 shrink-0 flex-col bg-gradient-to-b from-[#2b2361] via-[#352a70] to-[#231c4d] text-white">
    <div class="absolute top-0 inset-x-0 h-1 bg-[#8F7FD6]"></div>
    <div class="flex items-center justify-between gap-3 px-6 py-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo/emblem.svg') }}" alt="" class="h-8 w-8 shrink-0">
            <span class="text-lg font-bold tracking-wide">{{ __('auth.app_name') }}</span>
        </div>
        <button type="button" id="sidebar-close" class="text-white/70 hover:text-white lg:hidden" aria-label="{{ __('app.close') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="flex-1 space-y-6 px-4">
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
    </div>
    <div class="border-t border-white/10 px-4 py-4">
        <div class="truncate px-3 text-sm text-white/70">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit"
                class="w-full rounded-lg px-3 py-2 text-start text-sm font-medium text-white/70 transition hover:bg-white/5 hover:text-white">
                {{ __('auth.logout') }}
            </button>
        </form>
    </div>
</aside>