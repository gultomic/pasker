{{--TODO: add function when not connected to WS--}}
{{--todo: multiple letter on pelayanan TTS--}}
{{--todo: handle activating sound for the first time--}}
{{--todo: handle on error break the script--}}
{{--todo: connect running text to backend--}}
{{--todo: connect video to backend--}}
{{--todo: listen loket change from backend--}}
{{--todo: Youtube paused when playing sound--}}

<x-signage-layout>
    <div class="container-fluid signagearea">
        <div class="row">
            <div class="col-8 left-area">
                <div class="row header-area">
                    <div class="col-4">
                        <div class="logo ">
                            <img class="img-fluid w-40" src="/assets/logo_light.png" alt="">
                        </div>
                    </div>
                    <div class="col-8 pl-5 mascot-area mt-4">
                        <div class="tagline">
                            <h1 class="pasker-tagline mt-0 mb-0">
                                Pasker.ID
                            </h1>
                            <span class="tagline-child">
                            <span>#Get</span>
                            <span class="text-red-pasker">AJob</span>
                            <span>Live</span>
                            <span class="text-orange-pasker">Better</span>
                        </span>
                            <img class="mascot" src="/assets/pose01_preview_small.png">
                        </div>
                    </div>
                </div>
                <div class="white-wrap">
                <div class="row videoarea">
                    <div class="col-12 pt-3">
                        <iframe
                            src="https://www.youtube.com/embed/tmerNTqPosM?autoplay=1&mute=1"
                             allow="autoplay" frameborder="0" allowfullscreen=""
                            allowtransparency
                            &origin=https://OurWebsiteDomain"
                            allow="autoplay"
                        ></iframe>
                    </div>
                </div>
                <div class="row runningtext-area">
                    <div class="col-12 running-text-container mt-2 py-3 position-relative d-inline-table align-middle">
                        <span class="title-running-text text-white align-middle px-3">INFO</span>
                        <div id="text-running" class="text-running align-middle">Selamat Datang di PASKER.ID Silahkan Melakukan Konsultasi ++++ Waspada Bahaya Corona, Jaga Diri Anda dan Keluarga dengan Selalu Menerapkan Protokol 3T ++++ </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-4 right-area">
                <div class="row mt-4">
                    <div class="col-12 text-right">
                    <div id="mDate" class="" style=""></div>
                    <div id="mTime" class="mt-n-1" style="">00</div>
                    </div>
                </div>

                <div class="row tokenarea mt-2 pt-4 pr-3 pl-5 d-block">
                    <div class="line-orange-side">
                    </div>
                    <?php
                    $devide_num = 2;
                    if(count($loket) == 4){
                        $devide_num = 4.5;
                    }elseif (count($loket) == 5){
                        $devide_num = 3.8;
                    }
                    ?>
                    @foreach($loket as $i => $v)
                    <div id="{{ str_replace(' ', '', strtolower($v)) }}" class="token-card-container pb-3" style="height: @php echo (100/count($loket))-$devide_num @endphp% !important;">
                        <div class="token-card text-center">
                            <div class="title-loket py-2">
                                {{ $v }}
                            </div>
                            <div class="token-body text-center">
                                <div class="line-red"></div>
                                <div class="token-content-area">
                                    <div>
                                        <div class="token-number d-block w-100"></div>
                                        <div class="visitor-name d-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.spatial.min.js"></script>
        <script>

            $(function () {
                jQuery("#logopasker").trigger("click");
                jQuery("#text-running").eocjsNewsticker({
                    'divider':    '',
                });
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
                        appendToListCall(
                            e.collection.token.replace(/\s/g, ''),
                            e.collection.index,
                            e.collection.name,
                            e.collection.loket
                        );
                        console.log(e.collection)
                    }
                })

            var listToCall = [];

            function appendToListCall(noAntrian, noLoket,visitorName,loket) {
                //append 2 array in one time
                // for (let i = 0; i < 2; i++) {
                //
                // }

                listToCall.push({
                    'token': noAntrian,
                    'loket': noLoket,
                    'visitorName': visitorName,
                    'loketName': loket,
                })

                if(listToCall.length == 1){
                    startCallAntrian();
                }

                listToCall.push({
                    'token': noAntrian,
                    'loket': noLoket,
                    'visitorName': visitorName,
                    'loketName': loket,
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
                    onerror:function (err){
                        console.log(err)
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
                var namaLoket = listToCall[0].loketName;
                var visitorName = listToCall[0].visitorName;

                setLoketCardOnCall(namaLoket,noAntrian,visitorName);


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
                            setLoketCardIdle(namaLoket);
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

            function setLoketCardOnCall(loket,noAntrian,nama){
                jQuery(`#${loket} .token-number`).html(noAntrian);
                jQuery(`#${loket} .token-content-area`).removeClass('with-name')
                setLoketCardIdle(loket);
                jQuery(`#${loket} .visitor-name`).html('')
                if(nama!=""){
                    jQuery(`#${loket} .token-content-area`).addClass('with-name')
                    jQuery(`#${loket} .visitor-name`).html(nama)
                }
                //do active blinking
                jQuery(`#${loket} .token-content-area`).addClass('blink-me')
                jQuery(`#${loket} .title-loket`).addClass('active')

            }

            function setLoketCardIdle(loket){
                console.log('run')
                jQuery(`#${loket} .token-content-area`).removeClass('blink-me')
                jQuery(`#${loket} .title-loket`).removeClass('active')
            }


            $('body').on('click', function () {
                // console.log(soundAll[0])
                // console.log(soundAll)
                // alert('sfd')
                sound_test.play()
                // console.log(soundAll)
            })

            window.onerror = function(error) {
              // do something clever here
              alert(error); // do NOT do this for real!
            };


        </script>
    @endpush
</x-signage-layout>
