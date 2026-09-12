@props(['title' => ''])

<header class="flex items-center justify-between gap-3 border-b border-gray-200 bg-white px-4 py-4 sm:px-8">
    <div class="flex min-w-0 items-center gap-3">
        <button type="button" id="sidebar-open" class="shrink-0 text-gray-500 hover:text-gray-800 lg:hidden" aria-label="{{ __('app.menu') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="truncate text-xl font-semibold text-gray-900">{{ $title }}</h1>
    </div>
    <div class="inline-flex shrink-0 items-center gap-1 rounded-full bg-gray-100 p-1">
        @foreach (['ar' => 'AR', 'en' => 'EN'] as $locale => $label)
        <a href="{{ route('locale.switch', $locale) }}"
            class="rounded-full px-3 py-1 text-xs font-semibold transition {{ app()->getLocale() === $locale ? 'bg-[#2b2361] text-white' : 'text-gray-500 hover:text-gray-800' }}">{{ $label }}</a>
        @endforeach
    </div>
</header>
