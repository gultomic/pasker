@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <div class="grid grid-cols-12 gap-6">
        <livewire:pelayanan-rekap :id="$id" key="rekap" />
        <livewire:pelayanan-history :id="$id" key="history" />
    </div>
</x-midone-layout>
