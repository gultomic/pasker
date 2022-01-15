@props([
    'active',
    'icon' => 'fa-help',
])

@php
    $classes = ($active ?? false)
        ? 'border-lime-300 hover:border-lime-500'
        : 'border-transparent';
@endphp

<a {{ $attributes->merge(['class' => "relative flex py-2 pl-2 border-l-4 $classes text-neutral-300 hover:bg-green-300 hover:text-lime-500 hover:bg-opacity-20"]) }}
    x-bind:class="fullSidebar?'rounded-r-full':''"
>
    <i class='mr-2 text-xl fas {{ $icon }}'></i>

    <span x-show="fullSidebar"
        class="my-auto capitalize truncate lg:block md:hidden text-neutral-300">
        {{$slot}}
    </span>
</a>
