<div>
    <div class="px-5 pt-5 mt-5 intro-x box">
        <div class="flex flex-col pb-5 -mx-5 border-b border-gray-200 lg:flex-row dark:border-dark-5">
            <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                <div class="relative flex-none w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit">
                    <img alt="Rubick Tailwind HTML Admin Template"
                        class="rounded-full"
                        src="{{ $row->profile->refs['photo'] }}">
                    <div class="absolute bottom-0 right-0 flex items-center justify-center p-2 mb-1 mr-1 rounded-full bg-theme-1">
                        <i class="w-4 h-4 text-white" data-feather="camera"></i>
                    </div>
                </div>
                <div class="ml-5">
                    <div class="w-24 text-lg font-medium truncate sm:w-40 sm:whitespace-normal intro-y">{{ $row->profile->refs['fullname'] }}</div>
                    <div class="text-gray-600 intro-y">{{ $row->username }}</div>
                </div>
            </div>

            <div class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r border-gray-200 lg:mt-0 dark:text-gray-300 dark:border-dark-5 lg:border-t-0 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                <div class="flex flex-col items-center justify-center mt-4 lg:items-start">
                    <div class="flex items-center truncate sm:whitespace-normal intro-x">
                        <i data-feather="mail" class="w-4 h-4 mr-2"></i> {{ $row->email }}
                    </div>
                    <div class="flex items-center mt-3 truncate sm:whitespace-normal intro-x">
                        <i data-feather="shield" class="w-4 h-4 mr-2"></i> Role {{ $row->role->level }}
                    </div>
                    <div class="flex items-center mt-3 truncate sm:whitespace-normal intro-x">
                        <i data-feather="phone" class="w-4 h-4 mr-2"></i>{{ $row->phone }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 tab-content">
        <div class="grid grid-cols-12 gap-6">
            @foreach ($collection as $item)
            <div class="col-span-12 intro-y box lg:col-span-6">
                <div class="flex items-center justify-between p-3 border-b border-gray-200 dark:border-dark-5">
                    <div class="flex">
                        <i data-feather="award" class="w-6 h-6 mr-2 text-theme-11"></i>
                        <h2 class="mr-auto text-base font-medium">{{ $item['title'] }}</h2>
                    </div>

                    <div class="text-2xl font-medium">{{ $item['indeks'] }}%</div>
                </div>

                <div class="p-5">
                    <div class="grid grid-cols-2 mb-2">
                        <div>
                            <div class="font-medium">Total Melayani:</div>
                            <div class="text-gray-600"> {{ $item['total'] }} pengunjung</div>
                        </div>
                        <div>
                            <div class="font-medium">Total Skor:</div>
                            <div class="text-gray-600"> {{ $item['skor'] }}</div>
                        </div>
                    </div>
                    {{-- <div class="flex flex-col sm:flex-row">
                        <div class="mr-auto">
                            <a href="" class="font-medium">Wordpress Template</a>
                            <div class="mt-1 text-gray-600">HTML, PHP, Mysql</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 mt-5 mr-auto -ml-2 sm:ml-0 sm:mr-5">
                                <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                            </div>
                            <div class="text-center">
                                <div class="font-medium">6.5k</div>
                                <div class="bg-theme-18 text-theme-9 rounded px-2 mt-1.5">+150</div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="flex flex-col mt-5 sm:flex-row">
                        <div class="mr-auto">
                            <a href="" class="font-medium">Bootstrap HTML Template</a>
                            <div class="mt-1 text-gray-600">HTML, PHP, Mysql</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 mt-5 mr-auto -ml-2 sm:ml-0 sm:mr-5">
                                <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                            </div>
                            <div class="text-center">
                                <div class="font-medium">2.5k</div>
                                <div class="bg-theme-17 text-theme-11 rounded px-2 mt-1.5">+150</div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="flex flex-col mt-5 sm:flex-row">
                        <div class="mr-auto">
                            <a href="" class="font-medium">Tailwind HTML Template</a>
                            <div class="mt-1 text-gray-600">HTML, PHP, Mysql</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 mt-5 mr-auto -ml-2 sm:ml-0 sm:mr-5">
                                <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                            </div>
                            <div class="text-center">
                                <div class="font-medium">3.4k</div>
                                <div class="bg-theme-14 text-theme-10 rounded px-2 mt-1.5">+150</div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                {{-- {{ print_r($item) }} --}}
            </div>
            @endforeach
        </div>
        {{-- @dd($collection) --}}
    </div>
</div>
