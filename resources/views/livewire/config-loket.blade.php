<div class="col-span-12 intro-y box md:col-span-6 lg:col-span-3">
    <div class="flex items-center p-3 border-b border-gray-200 -intro-x sm:flex-row dark:border-dark-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h2 class="pl-2 mr-auto text-base font-medium">Master Data Loket</h2>
    </div>

    <div class="flex flex-col gap-2 p-2">
        <div class="flex justify-end">
            <button class="ml-1 btn btn-primary" wire:click='store'>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Loket
            </button>
        </div>

        @foreach ($row as $key => $item)
        <div class="flex items-center justify-between hover:bg-gray-200 intro-y">
            <div class="flex">
                <div class="flex items-center w-4 h-4 my-auto mr-2 text-center rounded-full bg-theme-9">
                </div>
                <div class="text-lg">{{ $item }}</div>
            </div>

            @if (count($row) == $key + 1)
                <button class="btn btn-sm btn-danger" wire:click='remove'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                </button>
            @endif
        </div>
        @endforeach
    </div>
</div>
