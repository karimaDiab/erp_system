<x-app-layout :title="__('app.edit')">
    <div class="w-full max-w-2xl rounded-xl border border-gray-200 bg-white p-4 sm:p-8">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @include('products._form')
        </form>
    </div>
</x-app-layout>
