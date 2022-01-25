<x-card-content class="bg-blue-400 text-slate-600">
    <x-slot name="cardHeader">
        <div class="flex items-center justify-between gap-6 pb-2">
            <div>
                {{-- ... --}}
            </div>

            <div>
                <button type="button"
                    class="px-2 text-sm border rounded-full border-slate-600 hover:bg-blue-300"
                    x-on:click="showModal=true"
                    wire:click="show('')">tambah</button>
            </div>
        </div>
    </x-slot>

    <x-slot name="contentSection">
        <x-card-modal type="primary" header="Tambah Data">
            @include('admin.pelayananForm')
        </x-card-modal>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-xs uppercase">
                    <tr>
                        <th class="p-2 bg-gray-200 rounded-l-lg">
                            <div class="font-semibold text-left">Nama</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-left">Kode</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Limit Antrian</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Total Tamu</div>
                        </th>
                        <th class="p-2 bg-gray-200">
                            <div class="font-semibold text-center">Aktif</div>
                        </th>
                        <th class="p-2 bg-gray-200 rounded-r-lg">
                            <div class="font-semibold text-center">Aksi</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y divide-sky-500">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-neutral-300 hover:bg-opacity-25">
                            <td class="p-2">
                                <div class="text-left">{{ $item->title }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-left">{{ $item->refs['kode'] }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->refs['antrian'] }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->pengunjung()->count() }}</div>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center">
                                    @if ($item->refs['aktif'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-center text-lime-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="flex items-center">
                                <button type="button"
                                    class="px-2 text-sm border rounded-full border-slate-600 hover:bg-yellow-300"
                                    x-on:click="showModal=true"
                                    wire:click="show({{ $item->id }})">edit</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-card-content>
