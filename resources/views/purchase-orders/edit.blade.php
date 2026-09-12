<x-app-layout :title="__('app.edit')">
    <div class="w-full max-w-4xl rounded-xl border border-gray-200 bg-white p-4 sm:p-8">
        <form method="POST" action="{{ route('purchase-orders.update', $order) }}">
            @include('purchase-orders._form')
        </form>
    </div>
</x-app-layout>
