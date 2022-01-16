<div>
    <div class="mb-4 border-b border-gray-500">
        Tanggal: {{ $date }} | Loket: ?
    </div>

    @foreach ($collection as $item)
        <div class="flex gap-4 px-2 py-1 hover:bg-lime-900">
            <div class="my-auto">
                @if (isset($item->refs['antrian']))
                <div class="px-3 text-2xl font-bold text-gray-700 rounded-full bg-lime-500">
                    {{ $item->refs['antrian'] }}
                </div>
                @else
                    ...
                @endif
            </div>

            <div class="my-auto">
                <button title="panggil" class="w-8 text-lg rounded-md ring hover:ring-slate-300 bg-cyan-500">
                    <i class="fas fa-bullhorn"></i>
                </button>

                <button class="w-8 text-lg bg-pink-500 rounded-md ring hover:ring-slate-300">
                    <i class="fas fa-times"></i>
                </button>

                <button class="w-8 text-lg rounded-md bg-emerald-600 ring hover:ring-slate-300">
                    <i class="fas fa-check"></i>
                </button>
            </div>

            <div class="flex-1">
                <div class="text-lg font-semibold leading-3">{{ $item->pengunjung->name }}</div>
                <div class="inline-flex text-sm">
                    <div class="pr-2 text-sky-500">
                        <i class="fas fa-phone-square-alt"></i>
                        {{ $item->pengunjung->phone }}
                    </div>
                    <div class="text-fuchsia-500">
                        <i class="fas fa-envelope-square"></i>
                        {{ $item->pengunjung->email }}
                    </div>
                </div>
            </div>

            <div>
                <div class="text-xs leading-3 text-center">pendaftaran:</div>
                <div class="leading-tight text-sky-500">online</div>
            </div>

            <div>
                <div class="text-xs leading-3 text-center">status:</div>
                <div class="px-2 text-sm leading-tight rounded-full bg-emerald-600">selesai</div>
            </div>

            <div>
                aksi
            </div>
        </div>
    @endforeach
</div>
