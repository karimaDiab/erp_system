<x-app-layout :title="__('app.add_new')">
    <div class="w-full max-w-4xl rounded-xl border border-gray-200 bg-white p-4 sm:p-8">
        <form method="POST" action="{{ route('production-orders.store') }}">
            @include('production-orders._form')
        </form>
    </div>
</x-app-layout>
