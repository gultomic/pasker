<div class="col-span-5 mt-8">
    <div class="flex items-center h-10 intro-y">
        <h2 class="mr-5 text-lg font-medium truncate">Status Loket</h2>
        <a href="" class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
        </a>
    </div>

    <div class="mt-12 sm:mt-5" wire:poll>
        @foreach ($collection as $item)
            <div class="intro-y">
                <div class="flex flex-col px-4 py-4 mb-3 box zoom-in">
                    <div class="text-lg font-medium leading-none truncate">
                        <span class="pr-1">{{ $item['nama'] }}:</span>
                        <span class="uppercase text-theme-19">{{ $item['pelayanan']}}</span>
                    </div>
                    <div class="mt-2">
                        <span class="pr-1 text-gray-600">Pelaksana:</span>
                        <span class="font-medium">{{ $item['pelaksana'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
