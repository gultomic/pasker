@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <livewire:profile key='profile' uname="{{ $username }}">
</x-midone-layout>
