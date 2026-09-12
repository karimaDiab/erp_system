<x-app-layout :title="__('app.nav_suppliers')">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-gray-500">{{ __('app.suppliers_intro') }}</p>
        <a href="{{ route('suppliers.create') }}" class="rounded-lg bg-[#2b2361] px-4 py-2 text-sm font-semibold text-white hover:bg-[#231c4d]">
            + {{ __('app.add_new') }}
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_name') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_email') }}</th>
                    <th class="px-6 py-3 text-start font-semibold text-gray-500">{{ __('app.field_phone') }}</th>
                    <th class="px-6 py-3 text-end font-semibold text-gray-500">{{ __('app.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $supplier->name }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $supplier->email ?? '—' }}</td>
                        <td class="px-6 py-3 text-gray-500">{{ $supplier->phone ?? '—' }}</td>
                        <td class="px-6 py-3 text-end">
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="font-medium text-[#2b2361] hover:underline">{{ __('app.edit') }}</a>
                            <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" class="inline" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-3 font-medium text-rose-600 hover:underline">{{ __('app.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">{{ __('app.no_records') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="mt-4">{{ $suppliers->links() }}</div>
</x-app-layout>
