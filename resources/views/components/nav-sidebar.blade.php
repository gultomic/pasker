@props([
    'active',
    'icon' => 'fa-help',
])

@php
    $classes = ($active ?? false)
        ? 'border-blue-500 hover:border-sky-300'
        : 'border-transparent';
@endphp

<a {{ $attributes->merge(['class' => "relative rounded-r-full flex py-2 pl-2 border-l-4 $classes hover:bg-blue-300 hover:text-blue-500 hover:bg-opacity-70"]) }}>
    <i class='mr-2 text-xl fas {{ $icon }}'></i>

    <span x-show="fullSidebar"
        class="my-auto capitalize truncate lg:block md:hidden">
        {{$slot}}
    </span>
</a>
