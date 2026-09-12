<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title.' · ' : '' }}{{ __('auth.app_name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700|instrument-sans:400,500,600"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    body {
        font-family: "{{ app()->getLocale()==='ar'? "'Cairo'": "'Instrument Sans'" }}",
        ui-sans-serif,
        system-ui,
        sans-serif;
    }
    </style>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">
    <div class="flex min-h-screen">
        <input type="checkbox" id="sidebar-toggle" class="peer hidden">

        <x-sidebar />

        <label for="sidebar-toggle"
            class="fixed inset-0 z-30 hidden bg-gray-900/50 peer-checked:block lg:hidden" aria-hidden="true"></label>

        <div class="flex min-w-0 flex-1 flex-col">
            <x-header :title="$title ?? ''" />

            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                @if (session('status'))
                <div class="mb-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
                @endif

                {{ $slot }}
            </main>

            <x-footer />
        </div>
    </div>
</body>

</html>