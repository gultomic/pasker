<x-card-content class="bg-white intro-x">
    <x-slot name="cardHeader">
        <form action="" class="intro-x">
            <div class="p-2 mt-3 border rounded-lg bg-theme-22">
                <div class="flex gap-x-3">
                    <div class="w-28">
                        <label for="" class="text-xs form-label">Nomor</label>
                        <input name=""
                            type="text"
                            class="form-control"
                            wire:model="nomor">
                    </div>

                    <div class="flex-1">
                        <label for="pertanyaan" class="text-xs form-label">Pertanyaan</label>
                        <div>
                            <select wire:model="pertanyaan"
                                name="pertanyaan"
                                class="w-full form-select">
                                {{-- <option value="" selected hidden>Pilih pertanyaan...</option> --}}
                                @foreach ($question as $item)
                                    <option value="{{ $item->id }}">{{ $item->pertanyaan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex mt-3">
                    <button type="submit"
                        class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-primary"
                        wire:click.prevent="store">simpan</button>

                    <button type="button"
                        class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-warning"
                        wire:click.prevent="resetForm">reset</button>
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
                            <div class="font-semibold text-left">Nomor</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-left">Pertanyaan</div>
                        </th>
                        <th class="p-2 bg-gray-300 rounded-r-lg">
                            <div class="font-semibold">Aksi</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-gray-200">
                            <td class="p-2">
                                <div class="text-left">{{ $item->nomor }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-left">{{ $item->pertanyaan->pertanyaan }}</div>
                            </td>
                            <td class="p-2">
                                <div class="flex gap-x-2">
                                    <button type="button"
                                        class="flex items-center font-light text-gray-600"
                                        wire:click="show({{ $item->id }})">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round" class="block mx-auto w-4 mr-0.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="flex items-center font-light text-theme-6"
                                        wire:click="remove({{ $item->id }})">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round" class="block mx-auto w-4 mr-0.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div>Tidak dapat menemukan data.</div>
            @endif
        </div>
    </x-slot>
</x-card-content>
