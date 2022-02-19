@php
    $tope = $pelayanan->pengunjung->count();
    $tosu = $collection->count();
    $tosk = $collection->sum('skor');
    $avsk = $collection->average('skor');
    $juso = $pelayanan->kuesioner->count();
@endphp

<div class="col-span-12 md:col-span-6">
    <h2 class="mr-auto text-lg font-medium">{{ $pelayanan->title }}</h2>

    <div class="relative px-5 mt-3 overflow-hidden box intro-y">
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
