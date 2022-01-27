<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    {{-- @dd($collection) --}}
    @foreach ($collection as $i => $v)
        <div class="pb-2">
            {{ $i }}
            <div class="pl-4">
                @foreach ($v as $x)
                    {{ $x }}
                @endforeach
            </div>
        </div>
    @endforeach
</div>
