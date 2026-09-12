@props(['title' => ''])

<header class="flex items-center justify-between gap-3 border-b border-gray-200 bg-white px-4 py-4 sm:px-6 lg:px-8">
    <div class="flex min-w-0 items-center gap-3">
        <label for="sidebar-toggle" class="cursor-pointer rounded-lg p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-800 lg:hidden" aria-label="{{ __('app.menu') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </label>
        <h1 class="truncate text-lg font-semibold text-gray-900 sm:text-xl">{{ $title }}</h1>
    </div>
    <div class="inline-flex shrink-0 items-center gap-1 rounded-full bg-gray-100 p-1">
        @foreach (['ar' => 'AR', 'en' => 'EN'] as $locale => $label)
        <a href="{{ route('locale.switch', $locale) }}"
            class="rounded-full px-3 py-1 text-xs font-semibold transition {{ app()->getLocale() === $locale ? 'bg-[#2b2361] text-white' : 'text-gray-500 hover:text-gray-800' }}">{{ $label }}</a>
        @endforeach
    </div>
</header>
