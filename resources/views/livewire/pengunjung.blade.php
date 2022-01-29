<x-card-content class="bg-white intro-x">
    {{-- <x-slot name="cardHeader">
    </x-slot> --}}

    <x-slot name="contentSection">
        <div class="overflow-x-auto">
            <table class="table">
                <thead class="text-xs uppercase">
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

                <tbody class="font-medium divide-y">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-gray-200 intro-x">
                            <td class="p-2">
                                <div class="text-left">{{ $item->name }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->phone }}</div>
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
