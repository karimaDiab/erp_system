<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title.' · ' : '' }}{{ __('auth.app_name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: {{ app()->getLocale() === 'ar' ? "'Cairo'" : "'Instrument Sans'" }}, ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <div class="flex min-h-screen">
        <aside class="flex w-64 shrink-0 flex-col bg-[#241f4d] text-white">
            <div class="px-6 py-6 text-lg font-bold tracking-wide">{{ __('auth.app_name') }}</div>

            <nav class="flex-1 space-y-6 px-4">
                <div>
                    <a href="{{ route('dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_dashboard') }}
                    </a>
                </div>

                <div>
                    <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">{{ __('app.nav_catalog') }}</div>
                    <a href="{{ route('products.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('products.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_products') }}
                    </a>
                </div>

                <div>
                    <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">{{ __('app.nav_sales') }}</div>
                    <a href="{{ route('customers.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('customers.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_customers') }}
                    </a>
                    <a href="{{ route('sales-orders.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('sales-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_sales_orders') }}
                    </a>
                </div>

                <div>
                    <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">{{ __('app.nav_procurement') }}</div>
                    <a href="{{ route('suppliers.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('suppliers.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_suppliers') }}
                    </a>
                    <a href="{{ route('purchase-orders.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('purchase-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_purchase_orders') }}
                    </a>
                </div>

                <div>
                    <div class="px-3 text-xs font-semibold uppercase tracking-wider text-white/40">{{ __('app.nav_production') }}</div>
                    <a href="{{ route('production-orders.index') }}" class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('production-orders.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                        {{ __('app.nav_production_orders') }}
                    </a>
                </div>
            </nav>

            <div class="border-t border-white/10 px-4 py-4">
                <div class="truncate px-3 text-sm text-white/70">{{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full rounded-lg px-3 py-2 text-start text-sm font-medium text-white/70 transition hover:bg-white/5 hover:text-white">
                        {{ __('auth.logout') }}
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="flex items-center justify-between border-b border-gray-200 bg-white px-8 py-4">
                <h1 class="text-xl font-semibold text-gray-900">{{ $title ?? '' }}</h1>
                <div class="inline-flex items-center gap-1 rounded-full bg-gray-100 p-1">
                    @foreach (['ar' => 'AR', 'en' => 'EN'] as $locale => $label)
                        <a
                            href="{{ route('locale.switch', $locale) }}"
                            class="rounded-full px-3 py-1 text-xs font-semibold transition {{ app()->getLocale() === $locale ? 'bg-[#3A306F] text-white' : 'text-gray-500 hover:text-gray-800' }}"
                        >{{ $label }}</a>
                    @endforeach
                </div>
            </header>

            <main class="flex-1 px-8 py-8">
                @if (session('status'))
                    <div class="mb-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
