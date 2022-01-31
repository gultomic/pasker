@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="flex items-center h-10 intro-y">
                <h2 class="mr-5 text-lg font-medium truncate">Rekapitulasi Pelayanan</h2>
                <a href="" class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
                    <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                </a>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-5">
                @foreach ($collection['pelayanan'] as $item)
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="p-5 box">
                            <div class="flex">
                                <i data-feather="award" class="report-box__icon text-theme-11"></i>
                                <div class="ml-auto">
                                    <div class="cursor-pointer report-box__indicator bg-theme-10 tooltip" title="33% Higher than last month">
                                        {{ $item['kepuasan'] }}% <i data-feather="star" class="w-4 h-4 ml-0.5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 text-3xl font-medium leading-8">{{ $item['pengunjung'] }}</div>
                            <div class="mt-1 text-base text-gray-600 truncate">{{ $item['title'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-span-6 mt-8">
            <div class="flex items-center h-10 intro-y">
                <h2 class="mr-5 text-lg font-medium truncate">Status Loket</h2>
            </div>

            <div class="mt-12 sm:mt-5">
                @foreach ($collection['loket'] as $item)
                    <div class="intro-y">
                        <div class="flex items-center px-4 py-4 mb-3 box zoom-in">
                            <div class="text-lg">{{ $item }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <x-card-content class="col-span-6 mt-8 bg-white intro-x">
            <x-slot name="contentSection">
                <div>
                    Yay you're in the admin dash!
                    <i class="text-blue-500 fab fa-500px"></i>
                </div>
                <div>{{ $collection['loket'] }}</div>
            </x-slot>
        </x-card-content>
    </div>
</x-midone-layout>
