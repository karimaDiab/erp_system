<aside
    class="fixed inset-y-0 start-0 z-40 flex w-64 -translate-x-full shrink-0 flex-col overflow-y-auto bg-gradient-to-b from-[#2b2361] via-[#352a70] to-[#231c4d] text-white transition-transform duration-200 ease-in-out peer-checked:translate-x-0 rtl:translate-x-full rtl:peer-checked:translate-x-0 lg:static lg:z-auto lg:translate-x-0 lg:rtl:translate-x-0">
    <div class="absolute top-0 inset-x-0 h-1 bg-[#8F7FD6]"></div>
    <div class="flex items-center justify-between px-6 py-6">
        <span class="text-lg font-bold tracking-wide">{{ __('auth.app_name') }}</span>
        <label for="sidebar-toggle" class="cursor-pointer rounded-lg p-1 text-white/70 hover:text-white lg:hidden" aria-label="{{ __('app.close') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </label>
    </div>

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
