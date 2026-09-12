<x-app-layout :title="__('app.edit')">
    <div class="max-w-2xl rounded-xl border border-gray-200 bg-white p-4 sm:p-8">
        <form method="POST" action="{{ route('customers.update', $customer) }}">
            @include('customers._form')
        </form>
    </div>
</x-app-layout>
