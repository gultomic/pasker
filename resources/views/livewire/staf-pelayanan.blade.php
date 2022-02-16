<div class="flex flex-col gap-4">

    <x-card-content-midone class="intro-x">
        <x-slot name="contentSection">

            <div class="lg:ml-2 lg:mr-auto  mt-3 lg:mt-0 ">
                <div class="text-gray-600 text-xs">Selamat Bekerja,</div>
                <div class="font-bold text-2xl  mt-0.5">{{ Auth::user()->profile->refs['fullname'] }}</div>
            </div>


            <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">

                <div class="box p-5 ml-2 mr-3 bg-success cursor-pointer">
                    <div class="text-opacity-80 text-xs">
                        Pelayanan
                    </div>

                    <div class="dropdown">
                        <div class="dropdown-toggle text-xl font-medium" aria-expanded="false">{{ $pelayananAktif }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4 ml-0.5">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="dropdown-menu w-80">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">

                                @foreach($pelayananList as $item)
                                    <a href="{{ route('dashboard.pelayanan', ['id' => $item->id]) }}"
                                       class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                        {{ $item->title }}
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    {{--                    <div class="font-medium text-2xl">Loket 1</div>--}}
                </div>

                <div class="box px-10 py-5 ml-2 mr-3 bg-success">
                    <div class="text-opacity-80 text-xs">
                        Loket
                    </div>
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center mt-1 text-sm font-medium transition duration-150 ease-in-out focus:outline-none"
                                wire:click='getAktifLoket'>
                                <div class="text-xl uppercase">{{ ($loketAktif == null) ? '...?' : $loketAktif }}</div>

                                <div class="ml-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4 ml-0.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @foreach ($loketList as $item)
                                <div class="p-2 text-black cursor-pointer hover:bg-slate-300"
                                     wire:click="setAktifLoket('{{ $item }}')">
                                    {{ $item }}
                                </div>
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                    {{--                    <div class="font-medium text-2xl">Loket 1</div>--}}
                </div>

            </div>
        </x-slot>
    </x-card-content-midone>


    <div class="grid grid-cols-12 gap-6 mt-5 mb-5">

        <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y">
            <div class="report-box zoom-in" wire:click='goToCard("menunggu")'>
                <div class="box p-5">
                    <div class="flex">
                        <i class="bi bi-hourglass-split text-3xl text-theme-6"></i>

                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ count($collection) }}</div>
                    <div class="text-base text-gray-600 mt-1">Menunggu</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y">
            <div class="report-box zoom-in" wire:click='goToCard("pending")' >
                <div class="box p-5">
                    <div class="flex">
                        <i class="bi bi-stopwatch text-3xl text-theme-12"></i>

                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ count($collection_pending) }}</div>
                    <div class="text-base text-gray-600 mt-1">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y">
            <div class="report-box zoom-in" wire:click='goToCard("selesai")' >
                <div class="box p-5">
                    <div class="flex">
                        <i class="bi bi-check-circle-fill text-3xl text-theme-9"></i>

                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ count($collection_selesai) }}</div>
                    <div class="text-base text-gray-600 mt-1">Selesai</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y">
            <div class="report-box zoom-in" wire:click='goToCard("tidakhadir")' >
                <div class="box p-5">
                    <div class="flex">
                        <i class="bi bi-person-x-fill text-3xl text-gray-600"></i>

                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">{{ count($collection_tidakhadir) }}</div>
                    <div class="text-base text-gray-600 mt-1">Tidak Hadir</div>
                </div>
            </div>
        </div>

    </div>


    <x-list-antrian-staff-action title="Memanggil" :collection="$collection_memanggil" :btnActive="['panggil','pending','proses','absent']" icon="bi-megaphone text-gray-600"/>
    <x-list-antrian-staff-action title="Pending" :collection="$collection_pending" :btnActive="['panggil','proses','absent']" icon="bi-stopwatch text-theme-12"/>
    <x-list-antrian-staff-action title="Menunggu" :collection="$collection" :btnActive="['panggil','pending','proses','absent']" icon="bi-hourglass-split text-theme-6"/>
    <x-list-antrian-staff-action title="Berjalan" :collection="$collection_berjalan" :btnActive="['pending','proses','absent']" icon=" bi-box-arrow-right text-gray-600"/>
    <x-list-antrian-staff-action title="Tidak Hadir" :collection="$collection_tidakhadir" :btnActive="['panggil','pending','proses']" icon="bi-person-x-fill text-gray-600"/>
    <x-list-antrian-staff-action title="Selesai" :collection="$collection_selesai" :btnActive="['biodata']" icon="bi-check-circle-fill text-theme-9"/>


    <script>

    window.addEventListener('gotocard', event => {
        // alert(event.detail.card)
        document.getElementById("card_"+event.detail.card).scrollIntoView({ behavior: 'smooth', block: 'start'})
    })

    window.addEventListener('loketIsEmpty', event => {
        alert("Silahkan Pilih Loket Terlebih Dahulu");
    })

    window.addEventListener('taskCompleted', event => {
        swal("Berhasil!", 'Berhasil menyelesaikan tugas', 'success')
        setTimeout(function (){
            location.reload();
        },1500)
    })




    </script>


</div>
