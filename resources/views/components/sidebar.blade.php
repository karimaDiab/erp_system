<aside
    class="relative flex w-64 shrink-0 flex-col bg-gradient-to-b from-[#2b2361] via-[#352a70] to-[#231c4d] text-white">
    <div class="absolute top-0 inset-x-0 h-1 bg-[#8F7FD6]"></div>
    <div class="px-6 py-6 text-lg font-bold tracking-wide">{{ __('auth.app_name') }}</div>

    <x-navbar />

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
