<x-signage-layout>
    <div class="container-fluid  hero-home pb-5 pb-5">
        <div class=" d-flex justify-content-between mt-3">
            <div class="col pt-3 text-left">
                <div class="row">
                    <div class="col-6 ml-5 ">
                        <img class="img-fluid" src="/assets/logo_light.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col text-center pt-3">
                <h1 class="text-white">Pasker ID</h1>
                <p class="text-white" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
            </div>
            <div class="col text-right mr-5 pt-2">
                <div id="mDate" class="text-uppercase " style="font-size: 0.9em"></div>
                <div id="mTime" class="mt-n-1" style="margin-top: -5px"></div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <div class="row mb-2">
                    <div class="col-6 ">
                        <div class="row glass mx-1">
                            <div class="background-orange d-block w-100 text-center  header-content-active"
                                 style="padding-top: 20px;padding-bottom: 20px">
                                NO ANTRIAN
                            </div>
                            <div class="content-active-token content-active text-center w-100 blinking" id="call_token">

                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row glass mx-1">
                            <div class="background-orange d-block w-100 text-center header-content-active"
                                 style="padding-top: 20px;padding-bottom: 20px">
                                LOKET
                            </div>
                            <div class="content-active-token content-active text-center w-100 blinking" id="call_loket">

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-5">

                    @foreach ($loket as $key => $item)
                        <div class="col-4 ">
                            <div class="row glass mx-1 mb-3">
                                <div class="background-red-pasker d-block w-100 text-center  header-content-active"
                                >
                                    {{ $item }}
                                </div>
                                <div class="content-active-token content-loket text-center w-100 " id="loket_{{ $key }}">

                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <div class="col-6 glass videoarea d-block rounded">
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
