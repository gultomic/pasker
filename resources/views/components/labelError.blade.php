@props(['message'])

<label {{ $attributes->merge(['class' => 'px-4 ml-1 text-xs tracking-wide text-white bg-red-500 rounded-full bg-opacity-60']) }}>
    {{ $message ?? $slot }}
</label>
