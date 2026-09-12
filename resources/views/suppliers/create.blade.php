<x-app-layout :title="__('app.add_new')">
    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-4 sm:p-8">
        <form method="POST" action="{{ route('suppliers.store') }}">
            @include('suppliers._form')
        </form>
    </div>
</x-app-layout>
