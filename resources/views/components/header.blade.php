@props(['title' => ''])

<header class="flex items-center justify-between border-b border-gray-200 bg-white px-8 py-4">
    <h1 class="text-xl font-semibold text-gray-900">{{ $title }}</h1>
    <div class="inline-flex items-center gap-1 rounded-full bg-gray-100 p-1">
        @foreach (['ar' => 'AR', 'en' => 'EN'] as $locale => $label)
        <a href="{{ route('locale.switch', $locale) }}"
            class="rounded-full px-3 py-1 text-xs font-semibold transition {{ app()->getLocale() === $locale ? 'bg-[#2b2361] text-white' : 'text-gray-500 hover:text-gray-800' }}">{{ $label }}</a>
        @endforeach
    </div>
</header>
