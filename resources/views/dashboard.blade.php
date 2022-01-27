@section('title', $title)
@section('header', $header)

<x-midone-layout>
    <x-card-content class="intro-x">
        <x-slot name="contentSection">
            <div>
                Yay you're logged in!
                <i class="text-blue-500 fab fa-500px"></i>
            </div>
        </x-slot>
    </x-card-content>
</x-midone-layout>
