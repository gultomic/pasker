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
                                <i data-feather="{{ ($item['status']) ? 'check' : 'x' }}"
                                    class="p-0.5 text-white rounded-full report-box__icon {{ ($item['status']) ? 'bg-theme-9' : 'bg-theme-6' }}"></i>
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

        <div class="col-span-5 mt-8">
            <div class="flex items-center h-10 intro-y">
                <h2 class="mr-5 text-lg font-medium truncate">Status Loket</h2>
                <a href="" class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
                    <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                </a>
            </div>

            <div class="mt-12 sm:mt-5">
                @foreach ($collection['loket'] as $item)
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

        <div class="col-span-7 mt-8">
            <div class="relative grid grid-cols-12 gap-6 intro-y">
                <div class="col-span-6">
                    <div class="flex items-center h-10">
                        <h2 class="mr-5 text-lg font-medium truncate">Ringkasan Kegiatan</h2>
                        <div class="flex items-center ml-auto text-theme-6 dark:text-theme-10">
                            <i data-feather="monitor" class="w-5 h-5 mr-3"></i>
                        </div>
                    </div>

                    <div class="mt-12 sm:mt-5">
                        <div class="flex flex-col">
                            <canvas id="bar-chart-widget" height="160"></canvas>
                            <canvas id="pelayanan-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-span-6">
                    <div class="flex items-center h-10">
                        <h2 class="mr-5 text-lg font-medium truncate">Status Pelayanan</h2>
                        <a href="" class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
                            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>

                    <div class="mt-5">
                        @foreach ($collection['status'] as $item)
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
                                <div class="px-2 py-1 text-sm text-white rounded-full cursor-pointer bg-theme-9">
                                    {{ $item->antrianHariIni()->where('refs->antrian', '!=', "")->count() }}
                                    <i data-feather="users" class="w-3 h-3 ml-1"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 mt-8">
            <div class="flex items-center h-10 intro-y">
                <h2 class="mr-5 text-lg font-medium truncate">Tabel Pelaksana</h2>
                <div class="flex items-center ml-auto text-theme-1 dark:text-theme-10">
                    <i data-feather="users" class="w-5 h-5 mr-3"></i>
                </div>
            </div>

            <div class="mt-8 overflow-auto intro-y lg:overflow-visible sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">PHOTO</th>
                            <th class="whitespace-nowrap">NAMA</th>
                            <th class="text-center whitespace-nowrap">LAYANAN</th>
                            <th class="text-center whitespace-nowrap">TOTAL</th>
                            <th class="text-center whitespace-nowrap">SKOR</th>
                            <th class="text-center whitespace-nowrap">INDEKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection['staf'] as $staf)
                            <tr class="intro-x">
                                <td class="w-40">
                                    <div class="flex">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="{{ $staf['nama'] }}"
                                                class="rounded-full tooltip"
                                                src="{{ asset($staf['photo']) }}"
                                                title="{{ $staf['nama'] }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium whitespace-nowrap">{{ $staf['nama'] }}</div>
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">{{ $staf['email'] }}</div>
                                </td>
                                <td class="text-center">{{ $staf['jumlah_pelayanan'] }} Pelayanan</td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center text-theme-9">
                                        {{ number_format($staf['total_pelayanan'], 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center">
                                        {{ number_format($staf['skor_survei'], 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center text-theme-1">
                                        {{ round($staf['indeks_kepuasan']) }}%
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        const collection = @json($collection['chart']);

        let ctx = cash("#bar-chart-widget")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            data:
            {
                labels: Object.keys(collection.bar),
                datasets: [
                    {
                        label: `Pengunjung`,
                        barPercentage: 0.5,
                        barThickness: 8,
                        maxBarThickness: 10,
                        minBarLength: 2,
                        data: Object.values(collection.bar),
                        backgroundColor: "#3160D8",
                    },
                ],
            },
            options: {
                scales: {
                    xAxes: [
                        {
                            ticks: {
                                fontSize: "12",
                                fontColor: "#777777",
                            },
                            gridLines: {
                                display: false,
                            },
                        },
                    ],
                    yAxes: [
                        {
                            ticks: {
                                fontSize: "12",
                                fontColor: "#777777",
                                callback: function (value, index, values) {
                                    return value;
                                },
                            },
                            gridLines: {
                                color: "#D8D8D8",
                                zeroLineColor: "#D8D8D8",
                                borderDash: [2, 2],
                                zeroLineBorderDash: [2, 2],
                                drawBorder: false,
                            },
                        },
                    ],
                },
            },
        });

        let pie = cash("#pelayanan-chart")[0].getContext("2d");
        let myPieChart = new Chart(pie, {
            type: "pie",
            data: {
                labels: _.map(collection.pie, 'title'),
                datasets: [
                    {
                        data: [90,10,20,21],
                        backgroundColor: ["#FF8B26", "#FFC533", "#285FD3"],
                        hoverBackgroundColor: ["#FF8B26", "#FFC533", "#285FD3"],
                        borderWidth: 5,
                        borderColor: cash("html").hasClass("dark")
                            ? "#303953"
                            : "#fff",
                    },
                ],
            },
            options: {
                title: {
                    display: true,
                    text: "Pelayanan",
                },
                legend: false,
            },
        });
    </script>
    @endpush
</x-midone-layout>

