<x-card-content class="bg-white intro-x">
    <x-slot name="contentSection">
        <div class="flex items-center p-2 mr-auto">
            <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">Value</label>
                <input type="search"
                    wire:model="search"
                    class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0"
                    placeholder="Search...">
            </div>
        </div>

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
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Kunjungan</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Dibuat</div>
                        </th>
                        <th class="p-2 bg-gray-200 rounded-r-lg">
                            <div class="font-semibold text-left">Aksi</div>
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
                                <div class="text-center">{{ $item->kunjungan->count() }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->created_at }}</div>
                            </td>
                            <td class="p-2">
                                <div class="flex gap-x-2">
                                    <a href="{{ route('admin.klien.show', ['id' => $item->id]) }}"
                                        class="flex items-center font-light text-theme-1">
                                        <i data-feather="alert-triangle" class="block mx-auto w-4 mr-0.5 text-"></i>
                                        Rincian
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center gap-6 mt-4">
            <div>
                <select class="form-select-sm sm:mr-2" wire:model="paginate" aria-label="select paginate">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="flex-1">
                {{ $collection->links() }}
            </div>
        </div>
    </x-slot>
</x-card-content>
