@section('title', $title)
@section('header', $header)

<x-app-layout>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($collection['pelayanan'] as $item)
            <x-card-content class="bg-black">
                <x-slot name="cardHeader">
                    <div class="text-xl font-extrabold uppercase">
                        {{ $item['title'] }}
                    </div>
                </x-slot>

                <x-slot name="contentSection">
                    <div class="flex justify-between pb-4 -mt-2">
                        <div class="px-2 border rounded-md">
                            <div>total antrian:</div>
                            <div>
                                {{ $item->antrianHariIni->count() }}
                            </div>
                        </div>

                        <div class="px-2 border rounded-md">
                            <div>limit antrian:</div>
                            <div>
                                {{ $item->refs['antrian'] }}
                            </div>
                        </div>

                        <div class="px-2 border rounded-md">
                            <div>nomor antrian:</div>

                        </div>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('dashboard.pelayanan', ['id' => $item->id]) }}"
                            class="block py-1 text-center bg-gray-500 border border-green-400 rounded-full hover:bg-gray-600">
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
