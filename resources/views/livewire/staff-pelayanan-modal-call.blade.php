{{--TODO : sweetlaert livewire--}}

<x-staf-pelayanan-modal>
    <x-slot name="title">

        @switch($state)
            @case('call')
            Pemanggilan Antrian
            @break

            @case('biodata')
            Biodata Pengunjung
            @break

            @case('onserving')
            Melayani
            @break

            @default
            Default case...
        @endswitch

    </x-slot>

    <x-slot name="content">

        @if($state == "call")
            <h2 class="text-xl leading-6 font-bold text-center ">Memanggil..</h2>
        <div class="flex justify-center  py-3">
            <span class="px-4 py-3 text-antrian-call-modal text-orange-pasker-light leading-6 font-bold blink_me">{{ $data->refs['antrian'] }}</span>
        </div>

        <div class=" flex justify-center py-5 intro-y">

            <button type="button" class="btn  w-32 btn-primary ml-3 mb-2"
                    x-on:click="buttonDisabled = true;setTimeout(() => buttonDisabled = false, 10000)"
                    wire:click='setActionModal("{{ $data->id }}","panggil")'
                    x-data="{ buttonDisabled: true }" x-bind:disabled="buttonDisabled" x-init="setTimeout(() => buttonDisabled = false, 10000)"
            >
                <i class="bi bi-megaphone"></i>&nbsp;Panggil Ulang</button>
            <button type="button" class="btn  w-32 btn-warning ml-3 mb-2" wire:click='setActionModal("{{ $data->id }}","pending")'><i class="bi bi-stopwatch"></i>&nbsp;Pending</button>
            <button type="button" class="btn  w-32 btn-danger ml-3 mb-2" onclick="confirm('Yakin ingin menyatakan pengunjung tidak hadir ?') || event.stopImmediatePropagation()" wire:click='setActionModal("{{ $data->id }}","tidak_hadir")'>
                <i class="bi bi-person-x-fill"></i>&nbsp;Tidak Hadir</button>
            <button type="button" class="btn  w-32 btn-success ml-3 mb-2" wire:click='setActionModal("{{ $data->id }}","biodata")'><i class="bi bi-box-arrow-right"></i>&nbsp;Proses</button>

        </div>
        @endif

        @if($state == 'biodata')
            <div class="flex mb-3">
                <div class="w-10 h-10 mr-2 flex-none ">
                    <i class="bi bi-person" style="font-size: 4rem"></i>
                </div>
                <div class="ml-5 mr-auto pt-2">
                    <h3 class="text-xl leading-6 font-bold text-orange-pasker-light ">Biodata Pengunjung</h3>
                    <p class="text-gray-600">Silahkan isi biodata pengunjung</p>
                </div>
            </div>

            <div class="">
                <label for="regular-form-1" class="form-label">Nama Lengkap</label>
                <input wire:model="name" type="text" class="form-control  @error('name') border-theme-6 @enderror"" placeholder="Masukkan Nama Lengkap" >
                @error('name')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mt-3">
                <label for="regular-form-1" class="form-label">No. Handphone</label>
                <input wire:model="phone" type="number" class="form-control @error('phone') border-theme-6 @enderror"  placeholder="Masukkan No Handphone">
                @error('phone')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror

            </div>

            <div class="mt-3">
                <label for="regular-form-2" class="form-label">Email</label>
                <input wire:model="email"  type="text" class="form-control @error('email')border-theme-6 @enderror " placeholder="Masukkan Email">
                @error('email')<div class="text-theme-6 mt-2">{{ $message }}</div>@enderror
            </div>
            <input wire:model="klienID" type="hidden" >
            <input wire:model="formType" type="hidden" >


            <div class="mt-5 flex justify-center">
                <button wire:click.prevent="store" type="submit" class="btn  w-32 btn-primary mr-1 mb-2" wire:click.prevent="store" ><i class="bi bi-save"></i>&nbsp;Simpan</button>
            </div>


        @endif

        @if($state == 'onserving')
            <h2 class="text-xl leading-6 font-bold  text-center">Anda Sedang Melayani..</h2>
            <div class="intro-y w-50">
                <div class="box px-4 py-4 mb-3 flex  zoom-in">
                    <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden bg-gray-200">
                        <img class="rounded-full" alt=""
                             src="{{ asset('assets/pose01_preview_small.png') }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-xl">{{ $data->pengunjung->name ?? "-" }}</div>
                        <div class="text-slate-500  mt-0.5">{{ $data->pengunjung->phone ?? "-" }}</div>
                        <div class="text-slate-500 mt-0.5">{{ $data->pengunjung->email ?? "-" }}</div>
                    </div>

                </div>
            </div>

            <div class="flex py-3 justify-between intro-y">

                <button type="button" class="btn btn-sm btn-outline-secondary inline-block mr-1 mb-2"
                        wire:click='setState("{{ $data->id }}","biodata")'>
                    <i class="bi bi-pencil"></i>&nbsp;Ubah Biodata
                </button>

                <button type="button" class="btn  btn-lg w-32 btn-success mr-1 mb-2"
                onclick="confirm('Yakin telah selesai ?') || event.stopImmediatePropagation()"
                wire:click='setActionModal("{{ $data->id }}","selesai")'
                >
                    <i class="bi bi-check-circle"></i>&nbsp;Selesai</button>

            </div>
        @endif

    </x-slot>

    <x-slot name="buttons">



    </x-slot>

</x-staf-pelayanan-modal>
