@php
    $tope = $pelayanan->pengunjung->count();
    $tosu = $collection->count();
    $tosk = $collection->sum('skor');
    $avsk = $collection->average('skor');
    $juso = $pelayanan->kuesioner->count();
@endphp

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <h2 class="mr-auto text-lg font-medium">{{ $pelayanan->title }}</h2>
    </div>

    <div class="col-span-12 md:col-span-6">
        <div class="relative px-5 overflow-hidden box intro-y">
            <canvas id="bar-chart-widget" height="150"></canvas>
        </div>

        <div class="relative p-5 mt-6 overflow-hidden box intro-y bg-theme-23">
            <div class="flex flex-col w-full gap-3 text-white">
                <div class="pl-4 border-l-2 border-theme-12">
                    <div>Total pengunjung: {{ number_format($tope, 0, ',', '.') }}</div>
                </div>
                <div class="pl-4 border-l-2 border-theme-12">
                    <div>Total survei: {{ number_format($tosu, 0, ',', '.') }}</div>
                </div>
                <div class="pl-4 border-l-2 border-theme-12">
                    <div>Indeks kepuasan: {{ round((($avsk/3)/$juso) * 100) }} %</div>
                </div>
                <div class="pl-4 border-l-2 border-theme-12">
                    <div>Skor: {{ number_format($tosk, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-6" x-data="alpTable({{$table}})" x-cloak>
        <div class="relative p-3 overflow-hidden box">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <span>Total: </span>
                    <span x-text="total"></span>
                    <span> records</span>
                </div>
                <select class="w-20 mt-3 form-select box sm:mt-0"
                    x-on:change="alpPaginate($event.target.value)" x-model="paginate">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                </select>
            </div>

            @if ($collection->count() > 0)
            <table class="table">
                <thead class="text-xs uppercase">
                    <tr>
                        <th class="p-2 bg-gray-300 rounded-l-lg">
                            <div class="font-semibold text-left">Tanggal</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-left">Total Pelayanan</div>
                        </th>
                        <th class="p-2 bg-gray-300 rounded-r-lg">
                            <div class="font-semibold">Skor</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y">
                    <template x-for="(item,x) in displayTable" :key="x" x-cloak>
                        <tr class="hover:bg-gray-200 intro-x">
                            <td class="p-2">
                                <div class="text-left" x-text="item.tanggal"></div>
                            </td>
                            <td class="p-2">
                                <div class="text-left" x-text="item.total"></div>
                            </td>
                            <td class="p-2">
                                <div class="text-left" x-text="item.skor"></div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div class="flex flex-wrap items-center mt-3 intro-y sm:flex-row sm:flex-nowrap">
                <ul class="pagination">
                    {{-- <li>
                        <button class="btn">
                            <i class="w-4 h-4" data-feather="chevrons-left"></i>
                        </button>
                    </li> --}}
                    <li>
                        <button class="btn" x-on:click="prevPage">
                            <i class="w-4 h-4" data-feather="chevron-left"></i>
                        </button>
                    </li>

                    <template x-for="x in pageCount" :key="x">
                        <li>
                            <button class="btn py-1.5 w-12" x-text="x" x-on:click="viewPage(x)"></button>
                        </li>
                    </template>

                    <li>
                        <button class="btn" x-on:click="nextPage">
                            <i class="w-4 h-4" data-feather="chevron-right"></i>
                        </button>
                    </li>
                    {{-- <li>
                        <button class="btn">
                            <i class="w-4 h-4" data-feather="chevrons-right"></i>
                        </button>
                    </li> --}}
                </ul>
            </div>
            </div>
            @else
                <div>Tidak dapat menemukan data.</div>
            @endif
        </div>
    </div>

    @push('script')
    <script>
        const collection = @json($barchart);

        let ctx = cash("#bar-chart-widget")[0].getContext("2d");
        let myChart = new Chart(ctx, {
            type: "bar",
            data:
            {
                labels: Object.keys(collection),
                datasets: [
                    {
                        label: `Pengunjung`,
                        barPercentage: 0.5,
                        barThickness: 8,
                        maxBarThickness: 10,
                        minBarLength: 2,
                        data: Object.values(
                            _.mapValues(collection, (obj) => {
                                return obj.length
                            })
                        ),
                        backgroundColor: "#3160D8",
                    },
                    {
                        label: `Skor`,
                        barPercentage: 0.5,
                        barThickness: 8,
                        maxBarThickness: 10,
                        minBarLength: 2,
                        data: Object.values(
                            _.mapValues(collection, (obj) => {
                                return _.sumBy(obj, (o) => {return o.skor})
                            })
                        ),
                        backgroundColor: "#a0afbf",
                    },
                ],
            },
            options: {
                title: {
                    display: true,
                    text: "Report Chart",
                    position: 'bottom',
                },
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
    </script>
    @endpush
</div>
