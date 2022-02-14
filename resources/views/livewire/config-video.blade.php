<div class="col-span-12 intro-y box">
    <div class="flex items-center p-3 border-b border-gray-200 sm:flex-row dark:border-dark-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h2 class="pl-2 mr-auto text-base font-medium">Video Lists</h2>
    </div>

    <div class="grid grid-cols-12 gap-2 p-2">
        <div class="col-span-12 md:col-span-7">
            <div class="grid grid-cols-3 gap-2">
            @foreach ($row as $key => $item)
                <div class="flex col-span-1 intro-x">
                    <iframe class="w-10/12 h-20"
                        src="https://www.youtube.com/embed/{{ $item }}?controls=0">
                    </iframe>

                    <div class="w-2/12 text-center pt-1.5 rounded-r-xl bg-dark-3">
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
        </div>

        <div class="col-span-12 md:col-span-5">
            <div class="flex items-center justify-between mb-1.5">
                <div class="w-full form-inline">
                    <label class="w-px italic text-gray-500 form-label">ID:</label>
                    <input id="" type="text" class="form-control" placeholder="youtube id" wire:model="text">
                    <button class="inline-block ml-1.5 hover:text-primary-9 btn btn-primary-soft" wire:click='store'>
                        simpan
                    </button>
                </div>
            </div>

            @if ($text == null)
            <div class="relative h-32 bg-gray-200 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 min-h-full m-auto intro-x" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            @else
                <div class="relative h-64">
                <iframe class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $text }}?autoplay=1">
                </iframe>
            </div>
            @endif
        </div>
    </div>
</div>
