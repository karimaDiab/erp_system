<x-auth-layout :heading="__('auth.welcome_back')" :subheading="__('auth.login_subtitle')">
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-white/80">{{ __('auth.email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="{{ __('auth.email_placeholder') }}"
                class="block w-full rounded-lg border-0 bg-white px-4 py-2.5 text-sm text-[#231c4d] placeholder:text-gray-400 focus:ring-2 focus:ring-white/60 focus:outline-none"
            >
            @error('email')
                <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="mb-1.5 flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-white/80">{{ __('auth.password') }}</label>
                <a href="{{ route('password.request') }}" class="text-xs text-white/60 hover:text-white">{{ __('auth.forgot_password') }}</a>
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="{{ __('auth.password_placeholder') }}"
                class="block w-full rounded-lg border-0 bg-white px-4 py-2.5 text-sm text-[#231c4d] placeholder:text-gray-400 focus:ring-2 focus:ring-white/60 focus:outline-none"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-2 text-sm text-white/70">
            <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/10 text-[#2b2361] focus:ring-white/60">
            {{ __('auth.remember_me') }}
        </label>

        <button
            type="submit"
            class="w-full rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#2b2361] transition hover:bg-white/90"
        >{{ __('auth.sign_in') }}</button>
    </form>

    <p class="mt-6 text-center text-sm text-white/60">
        {{ __('auth.no_account') }}
        <a href="{{ route('register') }}" class="font-semibold text-white hover:underline">{{ __('auth.create_account') }}</a>
    </p>
</x-auth-layout>
