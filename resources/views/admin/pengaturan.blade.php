@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <div class="grid grid-cols-12 gap-6">
        <livewire:config-loket key="loket">
        <livewire:config-jamoperasional key='operasional'>
        <livewire:config-marquee key="marquee">
        <livewire:config-video key="video">
    </div>
</x-midone-layout>
