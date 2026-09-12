<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('auth.app_name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo/emblem.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: "{{ app()->getLocale() === 'ar' ? "'Cairo'" : "'Instrument Sans'" }}", ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#2b2361] via-[#352a70] to-[#231c4d] text-white antialiased">
    <div class="relative flex min-h-screen flex-col items-center justify-center px-6 py-12">
        <div class="absolute top-6 start-6">
            <div class="inline-flex items-center gap-1 rounded-full bg-white/10 p-1">
                @foreach (['ar' => 'AR', 'en' => 'EN'] as $locale => $label)
                    <a
                        href="{{ route('locale.switch', $locale) }}"
                        class="rounded-full px-3 py-1 text-xs font-semibold transition {{ app()->getLocale() === $locale ? 'bg-white text-[#2b2361]' : 'text-white/70 hover:text-white' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>
        </div>

        <div class="w-full max-w-md">
            <div class="mb-6 flex flex-col items-center gap-3">
                <img src="{{ asset('images/logo/emblem.svg') }}" alt="{{ __('auth.app_name') }}" class="h-24 w-24 drop-shadow-lg">
                <span class="text-lg font-bold tracking-wide text-white">{{ __('auth.app_name') }}</span>
            </div>

            <div class="mb-8 flex justify-center">
                <div class="inline-flex w-full max-w-xs items-center gap-1 rounded-full bg-white/10 p-1">
                    <a
                        href="{{ route('login') }}"
                        class="flex-1 rounded-full px-4 py-2 text-center text-sm font-semibold transition {{ request()->routeIs('login') ? 'bg-white text-[#2b2361] shadow' : 'text-white/70 hover:text-white' }}"
                    >{{ __('auth.sign_in') }}</a>
                    <a
                        href="{{ route('register') }}"
                        class="flex-1 rounded-full px-4 py-2 text-center text-sm font-semibold transition {{ request()->routeIs('register') ? 'bg-white text-[#2b2361] shadow' : 'text-white/70 hover:text-white' }}"
                    >{{ __('auth.create_account') }}</a>
                </div>
            </div>

            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-white">{{ $heading }}</h1>
                <p class="mt-2 text-sm text-white/60">{{ $subheading }}</p>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
