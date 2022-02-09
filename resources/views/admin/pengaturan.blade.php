@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 intro-y box md:col-span-6 lg:col-span-4">
            <livewire:config-loket key="loket">
        </div>

        <div class="col-span-12 intro-y box md:col-span-6 lg:col-span-8">
            <livewire:config-jamoperasional key='operasional'>
        </div>

        <div class="col-span-12 intro-y box md:col-span-6">
            <div class="intro-y box">
                <div class="flex items-center p-3 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h2 class="pl-2 mr-auto text-base font-medium">Marquee Lists</h2>
                </div>
            </div>
        </div>

        <div class="col-span-12 intro-y box md:col-span-6">
            <div class="intro-y box">
                <div class="flex items-center p-3 border-b border-gray-200 sm:flex-row dark:border-dark-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <h2 class="pl-2 mr-auto text-base font-medium">Video Lists</h2>
                </div>
            </div>
        </div>
    </div>
</x-midone-layout>
