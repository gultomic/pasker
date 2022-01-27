<x-signage-layout>
    <div class="pb-5 container-fluid hero-home">
        <div class="mt-3  d-flex justify-content-between">
            <div class="pt-3 text-left col">
                <div class="row">
                    <div class="ml-5 col-6 ">
                        <img class="img-fluid" src="/assets/logo_light.png" alt="">
                    </div>
                </div>
            </div>
            <div class="pt-3 text-center col">
                <h1 class="text-white">Pasker ID</h1>
                <p class="text-white" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
            </div>
            <div class="pt-2 mr-5 text-right col">
                <div id="mDate" class="text-uppercase " style="font-size: 0.9em"></div>
                <div id="mTime" class="mt-n-1" style="margin-top: -5px"></div>
            </div>
        </div>
        <div class="mt-4 row">
            <div class="col-6">
                <div class="mb-2 row">
                    <div class="col-6 ">
                        <div class="mx-1 row glass">
                            <div class="text-center background-orange d-block w-100 header-content-active"
                                 style="padding-top: 20px;padding-bottom: 20px">
                                NO ANTRIAN
                            </div>
                            <div class="text-center content-active-token content-active w-100 blinking" id="call_token">

                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mx-1 row glass">
                            <div class="text-center background-orange d-block w-100 header-content-active"
                                 style="padding-top: 20px;padding-bottom: 20px">
                                LOKET
                            </div>
                            <div class="text-center content-active-token content-active w-100 blinking" id="call_loket">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-5 row">

                    @foreach ($loket as $key => $item)
                        <div class="col-4 ">
                            <div class="mx-1 mb-3 row glass">
                                <div class="text-center background-red-pasker d-block w-100 header-content-active"
                                >
                                    {{ $item }}
                                </div>
                                <div class="text-center content-active-token content-loket w-100 " id="loket_{{ $key }}">

                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <div class="rounded col-6 glass videoarea d-block">
                <div class="plyr__video-embed" id="player">
                  <iframe
                    src="https://www.youtube.com/embed/bTqVqk7FSmY?autoplay=1&mute=1"
                    allowfullscreen
                    allowtransparency
                    allow="autoplay"
                  ></iframe>
                </div>
            </div>

        </div>
        <img class="mascot-bottom-kiosk mascot-bottom" src="/assets/pose01_preview_small.png">
    </div>
    @push('scripts')
        <script>

            Echo.channel('QueuesEvent')
                .listen('QueuesService', (e) => {

                    console.log(e.collection)
                    document.querySelector(`#loket_${e.collection.index}`).innerHTML = e.collection.token
                    //document.querySelector(`#name_${e.collection.index}`).innerHTML = e.collection.name
                    document.querySelector('#call_token').innerHTML = e.collection.token
                    document.querySelector(`#call_loket`).innerHTML = e.collection.index+1
                })
        </script>
    @endpush
</x-signage-layout>
