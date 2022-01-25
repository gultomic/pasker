<x-card-content class="bg-blue-400">
    <x-slot name="cardHeader">
        <div class="flex gap-2">
            <span class="text-slate-200">Tanggal: </span>
            <span class="font-extrabold">{{ $date }}</span>
            <span class="text-slate-200">Loket Pelayanan: </span>

            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center mt-1 text-sm font-medium transition duration-150 ease-in-out focus:outline-none">
                        <div class="uppercase">{{ $loketAktif }}</div>

                        <div class="ml-1">
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @foreach ($loketList as $item)
                        <div class="p-2 text-black cursor-pointer hover:bg-slate-300"
                            wire:click="$set('loketAktif', '{{ $item }}')">
                            {{ $item }}
                        </div>
                    @endforeach
                </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <x-slot name="contentSection">
    @if ($collection->count() > 0)
        @foreach ($collection as $item)
            <div class="flex gap-4 px-2 py-1 hover:bg-slate-200 hover:bg-opacity-10">
                {{-- <div class="my-auto">
                    @if (isset($item->refs['antrian'])) --}}
                    <div class="px-3 my-auto text-2xl font-bold text-gray-700 rounded-full bg-lime-500">
                        {{ $item->refs['antrian'] }}
                    </div>
                    {{-- @else
                        ...
                    @endif
                </div> --}}

                <div class="my-auto">
                    <button title="panggil"
                        wire:click='setAction("{{ $item->id }}","panggil")'
                        class="w-8 text-lg rounded-md ring-2 hover:ring-slate-300 bg-cyan-500">
                        <i class="fas fa-bullhorn"></i>
                    </button>

                    <button title="tidak hadir"
                        wire:click='setAction("{{ $item->id }}","tidak ada")'
                        class="w-8 text-lg bg-pink-500 rounded-md ring-2 hover:ring-slate-300">
                        <i class="fas fa-times"></i>
                    </button>

                    <button title="hadir"
                        wire:click='setAction("{{ $item->id }}","berjalan")'
                        class="w-8 text-lg rounded-md bg-emerald-600 ring-2 hover:ring-slate-300">
                        <i class="fas fa-check"></i>
                    </button>
                </div>

                <div class="flex-1">
                    <div class="text-lg font-semibold leading-3">{{ $item->pengunjung ? $item->pengunjung->name : "-" }}</div>
                    <div class="inline-flex text-sm">
                        <div class="pr-2 text-sky-100">
                            <i class="fas fa-phone-square-alt"></i>
                            {{ $item->pengunjung ? $item->pengunjung->phone :"-"}}
                        </div>
                        <div class="text-fuchsia-200">
                            <i class="fas fa-envelope-square"></i>
                            {{ $item->pengunjung ? $item->pengunjung->email :""}}
                        </div>
                    </div>
                </div>

                <div class="w-24">
                    <div class="text-xs leading-3 text-center text-slate-200">status:</div>
                    @if ($item->refs['status'] == 'selesai')
                        <div class="px-2 text-sm leading-tight text-center border rounded-full border-sky-700 text-sky-700">
                    @elseif ($item->refs['status'] == 'tidak ada')
                        <div class="px-2 text-sm leading-tight text-center text-red-500 border border-red-500 rounded-full">
                    @else
                        <div class="px-2 text-sm leading-tight text-center">
                    @endif
                        {{ $item->refs['status'] ?? "-"}}
                    </div>
                </div>

                <div>
                    <div class="text-xs leading-3 text-center text-slate-200">pendaftaran:</div>
                    <div class="leading-tight {{ $item->refs['daftar']=='online'?'text-green-700':'text-amber-700'}}"
                        >{{ $item->refs['daftar'] }}</div>
                </div>

                <div>
                    <div class="text-xs leading-3 text-center text-slate-200">aksi:</div>
                    <div class="flex">
                        <button class="px-1 text-xs rounded-full hover:bg-sky-500"
                            wire:click='setAction("{{ $item->id }}","selesai")'>
                            <i class="fas fa-check-double"></i>
                            <span>selesaikan</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div>Tidak terdapat no antrian.</div>
    @endif
    </x-slot>
</x-card-content>
