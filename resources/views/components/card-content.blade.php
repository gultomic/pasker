<div {{ $attributes->merge([
    'class' => "overflow-hidden shadow-sm bg-opacity-70 rounded-2xl shadow-xl"
]) }} >

    @if ($cardHeader ?? null)
        <div class="px-4 py-2">
            {{ $cardHeader }}
        </div>
    @endif

    <div class="p-4">
        {{ $contentSection }}
    </div>
</div>
