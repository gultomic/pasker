<div class="col-span-6">
    <div class="flex items-center h-10">
        <h2 class="mr-5 text-lg font-medium truncate">Status Pelayanan</h2>
        <a href="" class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
        </a>
    </div>

    <div class="mt-5" wire:poll>
        @foreach ($collection as $item)
        <div class="intro-y">
            <div class="flex items-center px-4 py-4 mb-3 box zoom-in">
                <div class="items-center flex-none w-10 h-10 overflow-hidden bg-gray-400 rounded-md">
                    <div class="text-4xl font-black text-center">{{ $item->refs['kode']}}</div>
                </div>
                <div class="ml-4 mr-auto">
                    <div class="font-medium truncate">{{ $item->title}}</div>
                    <div class="text-gray-600 text-xs mt-0.5">
                        Dilayani {{
                            $item->antrianHariIni()
                                ->where('refs->antrian', '!=', "")
                                ->where('pelaksana_id', '!=', null)
                                ->count()
                        }}
                    </div>
                </div>
                <div class="flex px-2 py-1 text-white rounded-full cursor-pointer bg-theme-9">
                    {{ $item->antrianHariIni()->where('refs->antrian', '!=', "")->count() }}
                    <svg viewBox="0 0 24 24" class="w-4 h-4 ml-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
