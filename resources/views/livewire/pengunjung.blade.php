<x-card-content class="border border-gray-500">
    <x-slot name="cardHeader">
        <div class="flex items-center justify-between gap-6 pb-2">
            <div>
                ...
            </div>

            <div>
                +++
            </div>
        </div>
    </x-slot>

    <x-slot name="contentSection">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-xs text-gray-500 uppercase">
                    <tr>
                        <th class="p-2 bg-gray-200 rounded-l-lg">
                            <div class="font-semibold text-left">Nama</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">No. Telp</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Email</div>
                        </th>
                        <th class="p-2 bg-gray-200 rounded-r-lg">
                            <div class="font-semibold text-center">Aksi</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y divide-gray-600">
                    @foreach ($collection as $item)
                        <tr>
                            <td class="p-2">
                                <div class="text-left">{{ $item->name }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center text-blue-400">{{ $item->phone }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->email }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">aksi</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $collection->links() }}
        </div>
    </x-slot>
</x-card-content>
