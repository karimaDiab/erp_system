<x-app-layout :title="__('app.edit')">
    <div class="max-w-4xl rounded-xl border border-gray-200 bg-white p-8">
        <form method="POST" action="{{ route('sales-orders.update', $order) }}">
            @include('sales-orders._form')
        </form>
    </div>
</x-app-layout>
