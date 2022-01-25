@section('title', $title)
@section('header', $header)

<x-app-layout>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($collection['pelayanan'] as $item)
            <x-card-content class="bg-blue-400">
                <x-slot name="cardHeader">
                    <div class="text-xl font-extrabold uppercase">
                        {{ $item['title'] }}
                    </div>
                </x-slot>

                <x-slot name="contentSection">
                    <div class="grid grid-cols-4 gap-2 pb-4 -mt-2">
                        <div class="px-1 border rounded-md">
                            <div>terdaftar:</div>
                            <div>
                                {{ $item->antrianHariIni->count() }}
                            </div>
                        </div>

                        <div class="px-1 border rounded-md">
                            <div>limit:</div>
                            <div>
                                {{ $item->refs['antrian'] }}
                            </div>
                        </div>

                        <div class="px-1 border rounded-md">
                            <div>antrian:</div>
                            <div>
                                {{ $item->antrianHariIni()->where('refs->antrian', '!=', "")->count() }}
                            </div>
                        </div>
                        <div class="px-1 border rounded-md">
                            <div>dilayani:</div>
                            <div>
                                {{
                                    $item->antrianHariIni()
                                        ->where('refs->antrian', '!=', "")
                                        ->where('pelaksana_id', '!=', null)
                                        ->count()
                                }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('dashboard.pelayanan', ['id' => $item->id]) }}"
                            class="block py-1 text-center border rounded-full bg-neutral-400 hover:bg-neutral-300">
                            masuk untuk memulai pelayanan
                        </a>
                    </div>


                    <div class="text-xs italic text-yellow-400">
                        Deskripsi:
                    </div>

                    <div>
                        {!! $item['refs']['deskripsi'] !!}
                    </div>
                </x-slot>
            </x-card-content>
        @endforeach
    </div>
</x-app-layout>
