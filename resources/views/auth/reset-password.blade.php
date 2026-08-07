<x-auth-layout :heading="__('auth.reset_password_heading')" :subheading="__('auth.reset_password_subtitle')">
    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="mb-1.5 block text-sm font-medium text-white/80">{{ __('auth.email') }}</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $email) }}"
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
            <label for="password" class="mb-1.5 block text-sm font-medium text-white/80">{{ __('auth.password') }}</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="{{ __('auth.password_placeholder') }}"
                class="block w-full rounded-lg border-0 bg-white px-4 py-2.5 text-sm text-[#231c4d] placeholder:text-gray-400 focus:ring-2 focus:ring-white/60 focus:outline-none"
            >
            @error('password')
                <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-white/80">{{ __('auth.confirm_password') }}</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="{{ __('auth.password_placeholder') }}"
                class="block w-full rounded-lg border-0 bg-white px-4 py-2.5 text-sm text-[#231c4d] placeholder:text-gray-400 focus:ring-2 focus:ring-white/60 focus:outline-none"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-[#2b2361] transition hover:bg-white/90"
        >{{ __('auth.reset_password') }}</button>
    </form>
</x-auth-layout>
