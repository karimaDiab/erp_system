<x-auth-layout :heading="__('auth.forgot_password_heading')" :subheading="__('auth.forgot_password_subtitle')">
    @if (session('status'))
        <div class="mb-4 rounded-lg bg-white/10 px-4 py-2.5 text-center text-sm text-white">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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

        <button
            type="submit"
            class="w-full rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#2b2361] transition hover:bg-white/90"
        >{{ __('auth.send_reset_link') }}</button>
    </form>

    <p class="mt-6 text-center text-sm text-white/60">
        <a href="{{ route('login') }}" class="font-semibold text-white hover:underline">{{ __('auth.back_to_login') }}</a>
    </p>
</x-auth-layout>
