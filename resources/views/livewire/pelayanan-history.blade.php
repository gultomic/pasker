@php
    $tope = $pelayanan->pengunjung->count();
    $tosu = $collection->count();
    $tosk = $skoring->sum('skor');
    $avsk = $skoring->average('skor');
    $juso = $pelayanan->kuesioner->count();
@endphp

<x-card-content class="bg-white intro-x">
    <x-slot name="contentSection">
        <div class="overflow-x-auto">
            <div class="flex flex-wrap gap-3 pb-4">
                <div>Total pengunjung: {{ number_format($tope, 0, ',', '.') }}</div>
                <div>Total survei: {{ number_format($tosu, 0, ',', '.') }}</div>
                <div>Tingkat kepuasan: {{ round((($avsk/3)/$juso) * 100) }} %</div>
                <div>Skor: {{ number_format($tosk, 0, ',', '.') }}</div>
            </div>

            @if ($collection->count() > 0)
            <div class="flex flex-row flex-wrap gap-4">
                @foreach ($collection->groupBy('tanggal') as $key => $item)
                <div class="p-2 border">
                    <div class="pr-2">{{ $key }}</div>
                    <div>Pengunjung: {{ $item->count() }}</div>
                    <div>Skor: {{ $item->sum('skor') }}</div>
                </div>
                @endforeach
            </div>
            @else
                <div>Tidak dapat menemukan data.</div>
            @endif
        </div>
    </x-slot>
</x-card-content>
