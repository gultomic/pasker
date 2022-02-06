<?php
$cleanType = strtolower(str_replace(' ', '', $title));
?>

@if ($collection->count() <= 0 && strtolower($title) =="memanggil")
{{--    //empty for  box memanggil & count > 0--}}
@else
<div class="col-span-12 mt-6 box py-5 " id="card_{{$cleanType}}">
    <div class="intro-y block sm:flex items-center h-10 ml-4">
        <i class="bi {{ $icon }} text-lg mr-2"></i>
        <h2 class="text-lg font-medium truncate mr-3 uppercase">
            {{ $title }}
        </h2>

        <div class="text-sm text-gray-600 uppercase"> {{ count($collection) }} Pengunjung </div>

    </div>

    <div class="grid grid-cols-6 px-5 py-2">
        <div class="col-span-4"></div>
        <div class="text-center whitespace-nowrap text-xs font-medium">STAFF</div>
        <div class="text-center whitespace-nowrap text-xs font-medium">PENDAFTARAN</div>
{{--        <div class="text-center whitespace-nowrap text-xs font-medium">STATUS</div>--}}
    </div>

    @if ($collection->count() <= 0)
        <div class="p-5 ">
            <div class="alert alert-secondary show flex items-center mb-2 text-center" role="alert">
                <i class="bi bi-info-circle mr-2"></i>
                Tidak ada antrian saat ini
            </div>
        </div>
    @else
        @foreach($collection as $item)
            <div class="intro-y border-b grid grid-cols-6 px-5 py-3 gap-3">
                <div class="col-span-4">
                    <div class="flex gap-4">
                        <div class="text-2xl font-bold">{{ $item->refs['antrian'] }}</div>

                        <div>
                            @if (in_array("panggil", $btnActive))
                                <button title="panggil"
                                        wire:click='setAction("{{ $item->id }}","panggil",true)'
                                        class="btn btn-primary mr-1 mb-2">
                                    <i class="bi bi-megaphone-fill"></i>
                                </button>
                            @endif

                            @if (in_array("biodata", $btnActive))
                                <button title="Ubah Biodata"
                                        wire:click='setAction("{{ $item->id }}","edit_biodata")'
                                        class="btn btn-secondary mr-1 mb-2">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            @endif

                            @if (in_array("pending", $btnActive))
                                <button title="pending"
                                        wire:click='setAction("{{ $item->id }}","pending")'
                                        class="btn btn-warning mr-1 mb-2">
                                    <i class="bi bi-stopwatch"></i>
                                </button>
                            @endif

                            @if (in_array("proses", $btnActive))
                                @if($cleanType == "berjalan" && $item->pelaksana_id != auth()->user()->id)
                                @else
                                <button title="Proses"
                                        wire:click='setAction("{{ $item->id }}","biodata")'
                                        class="btn btn-success mr-1 mb-2">
                                    <i class="bi  bi-box-arrow-right"></i>
                                </button>
                                @endif
                            @endif

                            @if (in_array("absent", $btnActive))
                                <button title="Tidak Hadir"
                                        onclick="confirm('Yakin ingin menyatakan pengunjung tidak hadir ?') || event.stopImmediatePropagation()"
                                        wire:click='setAction("{{ $item->id }}","tidak_hadir")'
                                        class="btn btn-danger mr-1 mb-2">
                                    <i class="bi bi-person-x-fill"></i>
                                </button>
                            @endif
                        </div>

                        @if($item->klien_id!=0)
                            <div class="flex">
                                <div>
                                <i class="bi bi-person text-gray-600 text-2xl mr-1"></i>
                                </div>
                                <div>
                                    <div class="font-medium mb-0.5">{{ $item->pengunjung->name }}</div>
                                    <div class="text-xs text-gray-600">{{ $item->pengunjung->phone }}</div>
                                    <div class="text-xs text-gray-600">{{ $item->pengunjung->email ?? "-" }}</div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="text-center whitespace-nowrap text-xs font-medium ">
                    <div class="uppercase p-1">{{ $item->staff ? $item->staff->name : "-" }}</div>
                </div>
                <div class="text-center whitespace-nowrap text-xs font-medium ">
                    <div class="uppercase p-1">{{ $item->refs['daftar'] }}</div>
                </div>
{{--                <div class="text-center whitespace-nowrap text-xs font-medium ">--}}
{{--                    <div class="uppercase p-1">{{ $item->refs['status'] }}</div>--}}
{{--                </div>--}}
            </div>
        @endforeach
    @endif
</div>
@endif
