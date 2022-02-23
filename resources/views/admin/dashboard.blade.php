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

        <livewire:dashboard.statusloket key="loket">

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

                <livewire:dashboard.statuslayanan key="layanan">
            </div>
        </div>

        <div class="col-span-12 mt-8">
            <div class="flex items-center h-10 intro-y">
                <h2 class="mr-5 text-lg font-medium truncate">Tabel Pelaksana</h2>
                <div class="flex items-center ml-auto">
                    <a href="#!"
                        class="mr-2 text-gray-400 cursor-not-allowed tooltip"
                        data-theme="light"
                        title="Unduh excel"
                        disabled>
                        <i class="text-xl fas fa-file-pdf"></i>
                    </a>
                    <a href="{{ route('admin.pelaksana.export') }}"
                        class="mr-4 tooltip"
                        data-theme="light"
                        title="Unduh excel"
                        style="color: #018701;">
                        <i class="text-xl fas fa-file-excel"></i>
                    </a>
                    <i data-feather="users" class="w-5 h-5 mr-3 text-theme-1"></i>
                </div>
            </div>

            <div class="mt-8 overflow-auto intro-y lg:overflow-visible sm:mt-0"
                x-data="alpTable({{ $collection['staf'] }}, 3)" x-cloak>

                @if ($collection['staf']->count() > 0)
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
                        <template x-for="(item,x) in displayTable" :key="x" x-cloak>
                            <tr class="intro-x">
                                <td class="w-40">
                                    <div class="flex">
                                        <div class="w-10 h-10 rounded-full image-fit zoom-in">
                                            <img class="rounded-full tooltip"
                                                x-bind:alt="item.nama"
                                                x-bind:src="item.photo"
                                                x-bind:title="item.nama">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium whitespace-nowrap" x-text="item.nama"></div>
                                    <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5" x-text="item.email"></div>
                                </td>
                                <td class="text-center">
                                    <div x-text="item.jumlah_pelayanan+' Pelayanan'"></div>
                                </td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center text-theme-9"
                                        x-text="item.total_pelayanan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></div>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center"
                                        x-text="item.skor_survei.toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></div>
                                </td>
                                <td>
                                    <div class="flex items-center justify-center text-theme-1"
                                        x-text="item.indeks_kepuasan.toFixed(1)+'%'">
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div class="flex flex-wrap items-center justify-between mt-3 intro-y sm:flex-row sm:flex-nowrap">
                    <ul class="pagination">
                        <li>
                            <button class="p-1"
                                x-bind:class="pageNumber==1?'text-gray-400':'hover:bg-gray-300'"
                                x-bind:disabled="pageNumber==1?true:false"
                                x-on:click="prevPage">
                                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="w-5 h-5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                            </button>
                        </li>

                        <template x-for="x in pageCount" :key="x">
                            <li>
                                <button class="px-2 py-1 mx-1"
                                    x-bind:class="pageNumber==x?'border-b border-gray-500':'hover:bg-gray-300'"
                                    x-text="x"
                                    x-on:click="viewPage(x)"></button>
                            </li>
                        </template>

                        <li>
                            <button class="p-1"
                                x-bind:class="pageNumber==pageCount?'text-gray-400':'hover:bg-gray-300'"
                                x-bind:disabled="pageNumber==pageCount?true:false"
                                x-on:click="nextPage">
                                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="w-5 h-5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </li>
                    </ul>

                    <select class="w-20 mt-3 form-select box sm:mt-0"
                        x-on:change="alpPaginate($event.target.value)" x-model="paginate">
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </div>
                @else
                    <div>Tidak dapat menemukan data.</div>
                @endif
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

