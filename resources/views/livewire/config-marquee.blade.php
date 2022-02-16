<div class="col-span-12 intro-y box">
    <div class="flex items-center p-3 border-b border-gray-200 -intro-x sm:flex-row dark:border-dark-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h2 class="pl-2 mr-auto text-base font-medium">Marquee Lists</h2>
    </div>

    <div class="flex flex-col gap-2 p-2">
        <div class="grid justify-end grid-cols-2 gap-2">
            <div class="col-span-2 md:col-span-1">
            @foreach ($row as $key => $item)
                <div class="flex items-start justify-between p-1 hover:bg-gray-200 intro-x">
                    <div class="flex flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z" />
                          </svg>
                        <span class="">{{ $item }}</span>
                    </div>

                    <div class="flex">
                        <button class="text-gray-500 hover:text-primary-6" wire:click='show({{ $key }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                              </svg>
                        </button>
                        <button class="text-gray-500 hover:text-primary-3" wire:click='remove({{ $key }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="col-span-2 md:col-span-1">
                <div class="flex items-center justify-between mb-1.5">
                    <label class="my-auto italic text-gray-500 form-label">Input Text:</label>
                    <button class="inline-block py-0 hover:text-primary-9 btn btn-primary-soft btn-rounded" wire:click='store'>
                        simpan
                    </button>
                </div>
                <textarea class="form-control" rows="3" wire:model='text'></textarea>
            </div>
        </div>
    </div>
</div>
