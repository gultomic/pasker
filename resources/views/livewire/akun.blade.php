<x-card-content class="bg-white intro-x">
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
            <table class="table">
                <thead class="text-xs uppercase">
                    <tr>
                        <th class="p-2 bg-gray-300 rounded-l-lg">
                            <div class="font-semibold text-left">Email</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Username</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Telp</div>
                        </th>
                        <th class="p-2 bg-gray-300 rounded-r-lg">
                            <div class="font-semibold text-center">Aksi</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-gray-200 intro-x">
                            <td class="p-2">
                                <div class="text-left">{{ $item->email }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->username }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->phone }}</div>
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
