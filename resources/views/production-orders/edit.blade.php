<x-app-layout :title="__('app.edit')">
    <div class="max-w-4xl rounded-xl border border-gray-200 bg-white p-8">
        <form method="POST" action="{{ route('production-orders.update', $order) }}">
            @include('production-orders._form')
        </form>
    </div>
</x-app-layout>
