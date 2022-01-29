<x-card-content class="bg-white intro-x">
    <x-slot name="cardHeader">
        <form action="" class="intro-x">
        <div class="grid grid-cols-2 gap-6 p-2 mt-3 border rounded-lg bg-theme-22">
            <div>
                <div>
                    <label for="" class="text-xs form-label">Nama Pelayanan</label>
                    <input name=""
                        type="text"
                        class="form-control"
                        wire:model="title">
                </div>

                <div class="flex gap-x-4">
                    <div class="w-2/5">
                        <label for="" class="text-xs form-label">Kode/Huruf</label>
                        <input name=""
                            type="text"
                            class="uppercase form-control"
                            wire:model="kode">
                    </div>
                    <div class="w-2/5">
                        <label for="" class="text-xs form-label">Limit/Batas</label>
                        <input name=""
                            type="text"
                            class="form-control"
                            wire:model="antrian">
                    </div>
                    <div class="items-center w-1/5 pt-2 form-check">
                        <input name="aktif"
                            type="checkbox"
                            class="form-check-input"
                            wire:model="aktif">
                        <label class="form-check-label" for="">Aktif</label>
                    </div>
                </div>

                <div class="flex pt-3">
                    <button type="submit"
                        class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-primary"
                        wire:click.prevent="store">simpan</button>
                    <button type="button"
                        class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-warning"
                        wire:click.prevent="resetForm">reset</button>
                </div>
            </div>

            <div>
                <label for="" class="text-xs form-label">Deskripsi</label>
                <textarea name="" class="form-control" wire:model="deskripsi" rows="5"></textarea>
            </div>
        </div>
        </form>
    </x-slot>

    <x-slot name="contentSection">
        <div class="overflow-x-auto">
            @if ($collection->count() > 0)
            <table class="table">
                <thead class="text-xs uppercase">
                    <tr>
                        <th class="p-2 bg-gray-300 rounded-l-lg">
                            <div class="font-semibold text-left">Nama</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-left">Kode</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Limit Antrian</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Total Tamu</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold">Aktif</div>
                        </th>
                        <th class="p-2 bg-gray-300 rounded-r-lg">
                            <div class="font-semibold">Aksi</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-gray-200 intro-x">
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
                                <div class="flex">
                                    @if ($item->refs['aktif'])
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-center text-theme-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="flex gap-x-2">
                                    <button type="button"
                                        class="flex items-center font-light text-theme-11"
                                        wire:click="show({{ $item->id }})">
                                        <i data-feather="edit" class="block mx-auto w-4 mr-0.5 text-"></i>
                                        Edit
                                    </button>

                                    <a href="{{ route('admin.pelayanan.kuesioner', ['id' => $item->id]) }}"
                                        class="flex items-center font-light"
                                        >
                                        <i data-feather="file-text" class="block w-4 mr-0.5 mx-auto"></i>
                                        Kuesioner
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $collection->links() }}
            </div>
            @else
                <div>Tidak dapat menemukan data.</div>
            @endif
        </div>
    </x-slot>
</x-card-content>
