@section('title', $title)
@section('header', $header)

<x-midone-layout>

    <div class="grid grid-cols-12 gap-6 mt-5 mb-5">
        @foreach ($collection['pelayanan'] as $item)
        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
            <div class="report-box" >
                <div class="box p-5 text-center">
                    <div class="text-2xl uppercase font-bold text-center h-20 overflow-auto">{{ $item['title'] }}</div>

                    <div class="flex items-center justify-center -mt-1">
                        <div class="mt-3 w-20 h-20 pt-6 rounded-full bg-gray-200  ">
                            <div class="font-bold text-2xl uppercase text-gray-600 ">{{ $item->refs['kode'] }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-2 pb-4 mt-3 clear-both	">
                        <div class="px-2 py-2 border rounded-md text-center">
                            <div class="text-xs text-gray-600  ">terdaftar</div>
                            <div class="font-medium text-lg">
                                {{ $item->antrianHariIni->count() }}
                            </div>
                        </div>

                        <div class="px-2 py-2  border rounded-md text-center">
                            <div class="text-xs text-gray-600 ">limit</div>
                            <div class="font-medium text-lg">
                                {{ $item->refs['antrian'] }}
                            </div>
                        </div>

                        <div class="px-2 py-2 border rounded-md text-center">
                            <div class="text-xs text-gray-600 ">antrian</div>
                            <div class="font-medium text-lg">
                                {{ $item->antrianHariIni()->where('refs->antrian', '!=', "")->count() }}
                            </div>
                        </div>
                        <div class="px-2 py-2 border rounded-md text-center">
                            <div class="text-xs text-gray-600 ">dilayani</div>
                            <div class="font-medium text-lg">
                                {{
                                    $item->antrianHariIni()
                                        ->where('refs->antrian', '!=', "")
                                        ->where('pelaksana_id', '!=', null)
                                        ->count()
                                }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-center">
                        <a href="{{ route('dashboard.pelayanan', ['id' => $item->id]) }}"
                            class="btn btn-large btn-primary">
                            Klik untuk memulai pelayanan
                            <i class="ml-2 bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                    <div class="mt-3 text-xs text-gray-600">
                        {!! $item['refs']['deskripsi'] !!}
                    </div>

                </div>
            </div>
        </div>
        @endforeach

    </div>

</x-midone-layout>
