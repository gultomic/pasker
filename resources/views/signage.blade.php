{{--todo: handle activating sound for the first time done it works on openbrowser for smart tv--}}
{{--todo: handle on error break the script: should reload if auto play working on first reload--}}
{{--todo: connect running text to backend--}}
{{--todo: connect video to backend--}}
{{--todo: listen loket change from backend--}}

<x-signage-layout>
    <div class="container-fluid signagearea" x-data="loketData" x-on:rebuild-loket.window="items = $event.detail.items">
        <div class="row">
            <div class="left-area"
                 :class="items.length > 5 ? items.length == 6 ? 'col-7' :'col-6' : 'col-8'">
                <div class="row header-area">
                    <div class="col-4">
                        <div class="logo ">
                            <img class="w-40 img-fluid" src="/assets/logo_light.png" alt="">
                        </div>
                    </div>
                    <div class="pl-5 mt-4 col-8 mascot-area">
                        <div class="tagline">
                            <h1 class="mt-0 mb-0 pasker-tagline">
                                PASKER.ID
                            </h1>
                            <span class="tagline-child">
                            <span>#Get</span>
                            <span class="text-red-pasker poppinsmedium">AJob</span>
                            <span>Live</span>
                            <span class="text-orange-pasker poppinsmedium">Better</span>
                        </span>
                            <img class="mascot" src="/assets/pose01_preview_small.png">
                        </div>
                    </div>
                </div>
                <div class="white-wrap">
                <div class="row videoarea">
                    <div class="pt-3 col-12">
                        <div id="player"></div>
{{--                        <div id="player2"></div>--}}
                    </div>
                </div>
                <div class="row runningtext-area">
                    <div class="pt-3 pb-0 mt-3 align-middle col-12 running-text-container position-relative d-inline-table">
                        <span class="px-3 text-white align-middle title-running-text" >INFO</span>
                        <div id="text-running" class="align-middle text-running" >
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="right-area"
                 :class="items.length > 5 ? items.length == 6 ? 'col-5' :'col-6' : 'col-4'"
            >
                <div class="mt-4 row">
                    <div class="text-right col-12">
                    <div id="mDate" class="" style=""></div>
                    <div id="mTime" class="mt-n-1" style="">00</div>
                    </div>
                </div>

                <div class="pt-4 mt-2 row text-center tokenarea d-block"
                     :class="items.length > 5 ? 'pl-4' : 'pr-3  pl-5'"
                >
                    <div class="line-orange-side">
                    </div>
                    <template x-for="loket in items">
                        <div
                            :id="loket.replace(/\s/g, '').toLowerCase()"
                         class="pb-3 token-card-container"
                         :class="items.length > 5 ? 'two-row d-inline-block ' : ''"
                        :style="`height:${items.length > 5 ? items.length == 6 ? '25':'20' : (100/items.length) - (items.length == 4 ? 4.5 : 3.8)}% !important` "
                        >
                        <div class="text-center token-card">
                            <div class="py-2 title-loket text-uppercase" x-text="loket">

                            </div>
                            <div class="text-center token-body">
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
                    </template>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.core.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.spatial.min.js"></script>
        <script src="http://www.youtube.com/player_api"></script>


        <script>


            var marqueList = [
                "Selamat Datang di PASKER.ID Silahkan Melakukan Konsultasi.",
                "Waspada Bahaya Corona, Jaga Diri Anda dan Keluarga dengan Selalu Menerapkan Protokol 3T."
            ];


            var videoList = ["tmerNTqPosM"];
            var videoNum = 0 ;
            var player;

            Echo.channel('QueuesEvent.signage')
                .listen('QueuesService', (e) => {
                    if (e.collection.type == "call") {

                        appendToListCall(
                            e.collection.token.replace(/\s/g, ''),
                            e.collection.index,
                            e.collection.name,
                            e.collection.loket
                        );
                        //console.log(e.collection)
                    }

                    if(e.collection.type == "video"){
                        videoList = e.collection.newData;
                        videoNum = 0;
                        player.loadVideoById(videoList[videoNum]);
                    }

                    if(e.collection.type == "marque"){
                        updateTheMarque(e.collection.newData)
                    }

                    if(e.collection.type == "loketList"){
                        var event = new CustomEvent('rebuild-loket', {
                            detail: {
                                items: e.collection.newData
                            }
                        });
                        window.dispatchEvent(event);
                    }

                })

            window.Echo.connector.pusher.connection.bind('unavailable', (payload) => {

                /**
                 *  The connection is temporarily unavailable. In most cases this means that there is no internet connection.
                 *  It could also mean that Channels is down, or some intermediary is blocking the connection. In this state,
                 *  pusher-js will automatically retry the connection every 15 seconds.
                 */

                showWSError()


                console.log('unavailable');
            });

            window.Echo.connector.pusher.connection.bind('disconnected', (payload) => {

                /**
                 * The Channels connection was previously connected and has now intentionally been closed
                 */
                showWSError()

                console.log('disconnected');

            });
            window.Echo.connector.pusher.connection.bind('failed', (payload) => {

                /**
                 * Channels is not supported by the browser.
                 * This implies that WebSockets are not natively available and an HTTP-based transport could not be found.
                 */
                showWSError()

                console.log('failed', payload);

            });

            window.Echo.connector.pusher.connection.bind('error', (payload) => {

                /**
                 * Channels is not supported by the browser.
                 * This implies that WebSockets are not natively available and an HTTP-based transport could not be found.
                 */
                showWSError()


                console.log('error', payload);

            });

            function showWSError(){
                swal("Ups!",'Tidak dapat terhubung ke server realtime. Halaman akan di reload otomatis','error')
                setTimeout(function (){
                    location.reload();
                },3000)
            }
            // create youtube player

            // var ecoJS = jQuery("#text-running").eocjsNewsticker({
            //     'divider':    '',
            // });


            var $marquee = document.getElementById('text-running');
            var marquee = new dynamicMarquee.Marquee($marquee, {
                rate: -70
            });
            var controlmarque = dynamicMarquee.loop(
                marquee,
                marqueList.map(e=>{
                    return function (){
                        var $wrap = document.createElement('span');
                        $wrap.innerHTML = e;
                        return $wrap;
                    }
                })
            );

            function updateTheMarque(newArr){
                controlmarque.update(
                    newArr.map(e => {
                        return function ()
                        {
                            var $wrap = document.createElement('span');
                            $wrap.innerHTML = e;
                            return $wrap;
                        }
                    })
                )
            }


            function onYouTubePlayerAPIReady() {
                player = new YT.Player('player', {
                    // width: '640',
                    // height: '390',
                    videoId: videoList[videoNum],
                    events: {
                        onReady: onPlayerReady,
                        onStateChange: onPlayerStateChange,
                        onError:gotoNextVideo,
                    }
                });

            }

            // autoplay video

            //set volume &
            //player.setVolume(30)

            function onPlayerReady(event) {

                event.target.playVideo();
                event.target.setVolume(30)
            }

            function onPlayerStateChange(event) {
                if (event.data === 0) {
                    //console.log("bef"+videoNum)
                    //console.log("le"+videolist.length)
                    if(videoNum < (videoList.length)-1){
                        videoNum++;
                    }else{
                        videoNum = 0;
                    }
                    player.loadVideoById(videoList[videoNum]);
                }
            }

            function gotoNextVideo(event){
                videoNum = videoNum+1

                player.loadVideoById(videoList[videoNum]);

            }


            $(function () {
                jQuery("#logopasker").trigger("click");

            })

            var sound_test = new Howl({
                src: '{{asset('/assets/suara_antrian/def_noantrian.wav')}}',
                preload: true,
                onend: function () {
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
                //console.log('run')
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
                showWSError()
              //alert(error); // do NOT do this for real!
            };

        </script>


    @endpush

    @push('script-header')
        <script>


            document.addEventListener('alpine:init', () => {
                Alpine.data('loketData', () => ({
                    items: JSON.parse(@json($loketJson)),
            }));
            });
        </script>
    @endpush
</x-signage-layout>
