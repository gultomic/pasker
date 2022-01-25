@section('title', $title)
@section('header', $header)

<x-app-layout>
    <x-card-content class="bg-blue-400">
        <x-slot name="contentSection">
            <div>
                Yay you're logged in!
                <i class="text-blue-500 fab fa-500px"></i>
            </div>
        </x-slot>
    </x-card-content>
</x-app-layout>
