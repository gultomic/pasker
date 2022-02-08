{{--todo: multiple letter on pelayanan TTS--}}
<x-signage-layout>
    <div class="pb-5 container-fluid hero-home">
        <div class="mt-3  d-flex justify-content-between">
            <div class="pt-3 text-left col">
                <div class="row">
                    <div class="ml-5 col-6 " id="logopasker">
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
                                <div class="text-center content-active-token content-loket w-100 "
                                     id="loket_{{ $key }}">

                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <div class="rounded col-6 glass videoarea d-block">
                <div class="plyr__video-embed" id="player">
{{--                    <iframe--}}
{{--                        src="https://www.youtube.com/embed/bTqVqk7FSmY?autoplay=1&mute=1"--}}
{{--                        allowfullscreen--}}
{{--                        allowtransparency--}}
{{--                        allow="autoplay"--}}
{{--                    ></iframe>--}}
                </div>
            </div>

        </div>


        <img class="mascot-bottom-kiosk mascot-bottom" src="/assets/pose01_preview_small.png">
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.spatial.min.js"></script>
        <script>

            $(function () {
                $("#logopasker").trigger("click");
            })

            var sound_test = new Howl({
                src: '{{asset('/assets/suara_antrian/def_noantrian.wav')}}',
                preload: true,
                onend: function () {

                }
            })


            Echo.channel('QueuesEvent.signage')
                .listen('QueuesService', (e) => {


                    if (e.collection.call) {
                        document.querySelector(`#loket_${e.collection.index}`).innerHTML = e.collection.token
                        //document.querySelector(`#name_${e.collection.index}`).innerHTML = e.collection.name
                        document.querySelector('#call_token').innerHTML = e.collection.token
                        document.querySelector(`#call_loket`).innerHTML = e.collection.index + 1

                        appendToListCall(e.collection.token.replace(/\s/g, ''), e.collection.index + 1);
                        // console.log("tes");
                        // console.log(e.collection)

                    }

                })

            var listToCall = [];

            function appendToListCall(noAntrian, noLoket) {
                //append 2 array in one time
                // for (let i = 0; i < 2; i++) {
                //
                // }

                listToCall.push({
                    'token': noAntrian,
                    'loket': noLoket
                })

                if(listToCall.length == 1){
                    startCallAntrian();
                }

                listToCall.push({
                    'token': noAntrian,
                    'loket': noLoket
                })

                // listToCall.push({
                //     'token': noAntrian,
                //     'loket': noLoket
                // })



            }

            var list_nomor = [];

            for (let i = 0; i < 10; i++) {
                list_nomor.push(`/assets/suara_antrian/angka/${i}.wav`)
                // more statements
            }

            var list_abjad = [];

            for (let i = 0; i < 26; i++) {
                list_abjad.push(`/assets/suara_antrian/abjad/abjad_${i}.wav`)
                // more statements
            }


            var soundNomor = []

            for (const x in list_nomor) {
                // console.log(list_nomor[x]);
                var sound = new Howl({
                    src: [list_nomor[x]],
                    autoplay: false,
                    onload: function () {

                    },
                    onend:function(){


                    }
                });

                soundNomor.push(sound)
            }

            var soundAbjad = []

            for (const x in list_abjad) {
                // console.log(list_nomor[x]);
                var sound = new Howl({
                    src: [list_abjad[x]],
                    autoplay: false,
                    onload: function () {

                    }
                });

                soundAbjad.push(sound)
            }
            const alphabet = "abcdefghijklmnopqrstuvwxyz".split("");

            function startCallAntrian() {

                //console.log(listToCall);

                if (listToCall.length <= 0) {
                    return;
                }


                var noAntrian = listToCall[0].token;
                var noLoket = listToCall[0].loket;


                var arrNoAntrian = [];
                for (var i = 0; i < noAntrian.length; i++) {
                    arrNoAntrian.push(noAntrian[i]);
                }

                // console.log(arrNoAntrian);
                var list = [];
                list.push(soundAbjad[alphabet.indexOf(arrNoAntrian[0].toLowerCase())]);
                for (let i = 1; i < arrNoAntrian.length; i++) {
                    list.push(soundNomor[parseInt(arrNoAntrian[i])])
                }


                var sound_pre = new Howl({
                    src: '{{asset('/assets/suara_antrian/def_noantrian.wav')}}',
                    preload: true,
                    onend: function () {
                        noantrianSound(0, list, false)
                    }
                })

                var silakankeloket = new Howl({
                    src: '{{asset('/assets/suara_antrian/def_silakan.wav')}}',
                    preload: true,
                    onend: function () {

                        soundNomor[noLoket].play();

                        setTimeout(function () {
                            listToCall.shift();
                            //console.log(listToCall);
                            startCallAntrian();
                        }, 1200)

                        //noantrianSound(0, list_loket, true)
                    }
                })



                function noantrianSound(i, list, end) {
                    //console.log(list[i])
                    //console.log(i)
                    if ((i + 1) == list.length) {
                        //autoplay(0, list)
                        if (!end) {
                            setTimeout(function () {
                                silakankeloket.play()
                            }, 900)
                        }
                    } else {
                        //setTimeout(myGreeting, 5000);
                        setTimeout(function () {
                            noantrianSound(i + 1, list)
                        }, 700)
                        //console.log(list.length)
                    }
                    list[i].play();
                    // console.log(i)
                    // console.log(list.length)
                }

                //START CALL
                sound_pre.play()


            }


            $('body').on('click', function () {
                // console.log(soundAll[0])
                // console.log(soundAll)
                // alert('sfd')
                sound_test.play()
                // console.log(soundAll)
            })


        </script>
    @endpush
</x-signage-layout>
