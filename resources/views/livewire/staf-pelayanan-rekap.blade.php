<div class="col-span-12 md:col-span-6">
    <div class="relative p-5 overflow-hidden box bg-theme-7 intro-y">
        <div class="flex flex-col w-full gap-3 text-white">
            @foreach ($collection as $key => $item)
                <div class="flex items-center">
                    <div class="pl-4 border-l-2 border-theme-12">
                        <div class="font-medium">{{ $key }}</div>
                        <div class="text-gray-400">
                            <span class="tooltip" title="Total melayani">
                                <i data-feather="user" class="w-4 h-4 text-theme-12"></i> {{ $item->count() }}
                            </span>
                            <span class="ml-2 tooltip" title="Skor">
                                <i data-feather="star" class="w-4 h-4 text-theme-12"></i>
                                {{ number_format($item->sum('skor'), 0, ',', '.') }}
                            </span>
                            <span class="ml-2 tooltip" title="Indeks kepuasan">
                                <i data-feather="award" class="w-4 h-4 text-theme-12"></i>
                                @php
                                    $indeks = (($item->sum('skor') / 3) / $item->count()) * 100;
                                    echo number_format($indeks, 1, ',', '.') . '%';
                                @endphp
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="relative px-5 mt-6 overflow-hidden box intro-y">
        <canvas id="bar-chart-widget" height="125"></canvas>
    </div>

    @push('script')
    <script>
        const collection = @json($byweek);
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
                        data: _.map(collection, 'total'),
                        backgroundColor: "#3160D8",
                    },
                    {
                        label: `Skor`,
                        barPercentage: 0.5,
                        barThickness: 8,
                        maxBarThickness: 10,
                        minBarLength: 2,
                        data: _.map(collection, 'skor'),
                        backgroundColor: "#a0afbf",
                    },
                ],
            },
            options: {
                title: {
                    display: true,
                    text: "Weekly Chart",
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
