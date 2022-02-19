@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <div class="grid grid-cols-12 gap-6">
        <livewire:staf-pelayanan-rekap key="rekap" />
        <livewire:staf-pelayanan-history key="history" />
    </div>
</x-midone-layout>
