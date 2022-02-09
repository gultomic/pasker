<div class="intro-y box">
    <div class="flex items-center p-3 border-b border-gray-200 sm:flex-row dark:border-dark-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h2 class="pl-2 mr-auto text-base font-medium">Master Data Loket</h2>
    </div>

    <div class="flex flex-col gap-2 p-2">
        <div class="flex">
            <input type="text" class="form-control" placeholder="input data..">
            <button class="ml-1 btn btn-primary">
                <i data-feather="hard-drive" class="w-4 h-4"></i>
            </button>
        </div>
        @php
            $x = 1;
        @endphp
        @foreach ($collection as $item)
        <div class="flex items-center justify-between p-1 rounded-lg hover:bg-gray-200">
            <div class="flex">
                <div class="flex items-center w-8 h-8 my-auto mr-2 text-center rounded-full bg-theme-9">
                    <span class="mx-auto text-lg font-semibold text-gray-300">{{$x++}}</span>
                </div>
                <div class="text-xl">{{ $item }}</div>
            </div>

            <button class="btn btn-sm btn-warning">
                <i data-feather="edit-3" class="w-4 h-4"></i>
            </button>
        </div>
        @endforeach
    </div>
</div>
