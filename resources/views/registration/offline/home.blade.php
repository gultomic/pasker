{{--TODO : Buang static qrcode--}}
{{--TODO : aktifin print function--}}

@extends('layouts.bootstrap_public')

@section('content')
    <div class="pageonload main-loader">
        <div class="loader">
            <p><img src="/assets/pose01_preview_small.png"/><br/>Loading..</p>
        </div>
    </div>

    <div class="to-print">

            <p class="text-center" style="margin:0; font-size: 15pt;line-height: 5px;margin-bottom: 15px;margin-top:10px">PASKER.ID</p>
            <p id="print-date" class="text-center" style="margin:0;font-size: 10pt;line-height: 5px;margin-bottom: 30px">Senin, 20 Desember 2022 - 10:30:22</p>
            <p class="text-center" style="margin:0;font-size: 16pt;line-height: 5px;margin-bottom: 40px">Nomor Antrian</p>
            <p id="print-token" class="text-center" style="margin:0;font-size: 30pt;line-height: 5px;margin-bottom: 40px">A030</p>
            <p id="print-layanan" class="text-center" style="margin:0;font-size: 15pt;line-height: 5px"><strong>Pelayanan Komuk</strong></p>

    </div>

    <div id="body-kiosk" class="hidden-print">
        <div id="areaone-kiosk-container" class="kiosk-container container-fluid hero-home-kiosk pb-3">
            <div class="row pt-5">
                <div class="col pl-5">
                    <a href="{{route('kiosk.homepage')}}" class="mt-4 btn btn-lg ml-3 btn-outline text-white">
                        <i class="bi bi-arrow-clockwise"></i>
                        Reload Halaman
                    </a>
                </div>
                <div class="col text-right clock-area pr-4">
                    <div id="mDateKiosk" class="text-uppercase "></div>
                    <div id="mTimeKiosk" class="">::</div>
                </div>
            </div>
            <div class="row mt-n5">
                <div class="col logo text-center">
                    <img class="img-fluid h-32" src="/assets/logo_light.png" alt="">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col tagline text-center">
                    <h1 class="mb-2 pasker-tagline">
                        PASKER.ID
                    </h1>
                    <span class="tagline-child">
                <span>#Get</span>
                <span class="text-red-pasker poppinsmedium">AJob</span>
                <span>Live</span>
                <span class="text-orange-pasker poppinsmedium">Better</span>
                </span>
                </div>
            </div>


            <div class="row justify-content-center running-text-area">
                <div class="col col-11">
                    <div class="text-running-container py-2 text-white px-3">
                        <div id="text-running" class="align-middle text-running"></div>
                    </div>
                </div>
            </div>

            <div class="row button-area mt-3 justify-content-center ">
                <div class="card-deck text-center text-black-50 col col-11 ml-0 mr-0">

                    <div id="online-btn" class="shadow card box-shadow kiosk-btn-home px-5 py-5 ml-0">
                        <div class="row justify-content-center mb-4 mt-3">
                            <div class="col-8">
                                <img class="img-fluid" src="/assets/online-icon.png" alt="">
                            </div>
                        </div>
                        <h2 class="text-body">Antrian Online</h2>
                        <p>Tekan disini jika anda <strong>SUDAH</strong> melakukan registrasi via online</p>
                    </div>

                    <div id="offline-btn" class="shadow card box-shadow kiosk-btn-home px-5 py-5 mr-0">
                        <div class="row justify-content-center mb-4 mt-3">
                            <div class="col-8 ">
                                <img class="img-fluid" src="/assets/offline-icon.png" alt="">
                            </div>
                        </div>
                        <h2 class="text-body">Antrian Offline</h2>
                        <p>Tekan disini jika anda <strong>BELUM</strong> melakukan registrasi via online</p>
                    </div>

                </div>
            </div>


        </div>

        <div id="jobiarea-kiosk-container" class="kiosk-container container-fluid px-5 py-5 mb-5">

            <div id="toFadeIn" class="tagline-set">
                <div id="tagline-1" class="animate__animated tagline-item tagline-fadein ">
                    #SIAPKerja
                </div>

                <div id="tagline-2" class="animate__animated tagline-item tagline-fadein tagline-item-orange">
                    #KarierHub
                </div>
                <div id="tagline-3" class="animate__animated tagline-item tagline-fadein tagline-item-red">
                    #TalentHub
                </div>

                <div id="tagline-4" class="animate__animated tagline-fadein tagline-item tagline-item-greenlight ">
                    #GetAJobLive<br/>Better
                </div>
            </div>

            <img class="mascot-bottom-kiosk mascot-bottom" src="/assets/pose01_preview_small.png">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-kiosk hidden-print" id="onlineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false"
    >
        <div class="modal-dialog modal-lg">

            <div class="modal-content px-5">
                <div class="modal-body text-center">

                    <div class="row text-center justify-content-center spinnerkiosk-online" style="display: none">
                        <div class=" spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <div class="py-5 step-state" id="init-state">
                        <h2>Pilih Metode</h2>
                        <div class="row text-center justify-content-center mt-4">
                            <div id="online-barcode-input" class="col-5 method_list_online py-5 mr-2">
                                <i class="bi bi-upc-scan"></i>
                                <span class="d-block">Scan Barcode</span>
                            </div>
                            <div id="online-input-phone" class="col-5 method_list_online py-5 mr-2">
                                <i class="bi bi-phone"></i>
                                <span class="d-block">Input No Handphone</span>
                            </div>
                        </div>
                    </div>

                    <div class="py-5 step-state" id="inputphone-state" style="display:none;">
                        <h2 class="text-center text-pasker ">Masukkan No. Handphone</h2>
                        <p class="text-center">Masukkan No. Handphone yang anda daftarkan pada saat registrasi
                            online</p>
                        <div class="alert alert-danger phonenot0" style="display: none;font-size: 0.9rem">
                            No Handphone harus diawali dengan angka 0
                        </div>

                        <div class="row text-center justify-content-center spinnerkiosk-phone-submit" style="display: none">
                            <div class=" spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        <div class="input-phone-area">
                            <input data-kioskboard-type="numpad" type="number" id="phone"
                                   class="form-control js-num-virtual-keyboard"
                                   placeholder="Masukkan No Handphone diawali dengan angka 0">
                            {{--                        <div class="input-group input-group w-100 ">--}}
                            {{--                            <div class="input-group-prepend">--}}
                            {{--                                <span class="input-group-text" id="inputGroup-sizing-sm" >+62</span>--}}
                            {{--                            </div>--}}
                            {{--                            --}}
                            {{--                        </div>--}}


                        <button id="submit-phone" disabled data-href="{{route('kiosk.submit_phone')}}"
                                class="btn btn-pasker-main btn-lg text-white mt-4">SUBMIT
                        </button>
                        </div>
                    </div>

                    <div class="step-state py-5" id="barcodeinput-state" style="display:none;">
                        <h2>Scan Barcode</h2>
                        <p>Silahkan arahkan QRCode pada barcode scanner</p>

                        <div class="row text-center justify-content-center spinnerkiosk-barcode-scan" style="display: none">
                            <div class=" spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        <img src="{{ asset('assets/barcodescan.png') }}" class="img-fluid my-3 illustrator-barcode-scan" alt="">
                        <form  id="barcodeSubmitCode">
                            <input type="text" id="barcode-input-form" style="display:none;">
                        </form>

                    </div>


                    <div class="py-5 step-state" id="error-state" style="display: none">
                        <h2 class="text-center text-danger " id="error_title"></h2>

                        <i class="bi bi-emoji-frown text-muted"></i>

                        <p class="text-muted" id="error_desc"></p>
                        <button id="retry-input-online" data-backto="" class="btn btn-pasker-main text-white mt-4">COBA KEMBALI</button>
                    </div>


                    <div class="py-5  step-state print-state" style="display: none">
                        <h2 class="text-center text-pasker ">Ambil Antrian Anda</h2>

                        <p>Melakukan print no antrian anda, silahkan menunggu...</p>
                        <small class="m-0">No Antrian anda: </small>
                        <p class="font-weight-bold m-0 print-no-out" style="font-size: 3rem">D80</p>
                        <i style="font-size:7rem;" class="d-block  bi bi-printer text-warning"></i>

                        <small class="d-block text-muted countdown-print"></small>
                    </div>


                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-kiosk hidden-print" id="offlineModal" tabindex="-1" aria-hidden="true"
         data-backdrop="static" data-keyboard="false"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content px-5">
                {{-- <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body text-center">

                    <div class="py-5 step-state" id="pick-layanan-state">
                        <h2 class="text-center text-pasker ">Pilih Layanan</h2>
                        <p class="text-center">Silahkan pilih layanan yang ingin anda ambil</p>
                        <input type="hidden" id="kiosk-submit-url" value="{{route('kiosk.submit')}}">
                        <div class=" mt-5">
                            {{-- <div class="container">
                                @foreach ($pelayanan as $item)
                                <div class="span3 text-center item-pelayanan text-uppercase">
                                  <div class="circle">
                                  </div>
                                </div>
                                @endforeach
                            </div> --}}
                            <div class="row text-center justify-content-center spinnerkiosk-offline"
                                 style="display: none">
                                <div class=" spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="row text-center justify-content-center list-layanan-active">
                                @foreach ($pelayanan as $item)

                                    <span
                                        class="col-md-3 text-center item-pelayanan text-uppercase ml-4 py-5 pt-5 rounded"
                                        data-pelayanan="{{ $item->id }}"
                                    >

                                {{$item->title}} </span>
                                @endforeach
                            </div>


                        </div>
                    </div>


                    <div class="py-5  step-state print-state" style="display: none">
                        <h2 class="text-center text-pasker ">Ambil Antrian Anda</h2>

                        <p>Melakukan print no antrian anda, silahkan menunggu...</p>
                        <small class="m-0">No Antrian anda: </small>
                        <p class="font-weight-bold m-0 print-no-out" style="font-size: 3rem">D80</p>
                        <i style="font-size:7rem;" class="d-block  bi bi-printer text-warning"></i>

                        <small class="d-block text-muted countdown-print"></small>
                    </div>


                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>



    @push('styles')
        <link href="/css/kiosk.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @endpush

    @push('script')

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dynamic-marquee@2"></script>

        <script>

            function fade(element) {
                //console.log(element.style);
                var op = 1;  // initial opacity
                var timer = setInterval(function () {
                    if (op <= 0.1){
                        clearInterval(timer);
                        element.style.display = 'none';
                    }
                    element.style.opacity = op;
                    element.style.filter = 'alpha(opacity=' + op * 100 + ")";
                    op -= op * 0.1;
                }, 50);
            }

            window.addEventListener("load", function(event) {
                // Animate loader off screen
                var element = document.getElementsByClassName('main-loader');
                //
                fade(element[0])
            });

            var marqueList = JSON.parse(@json($marqueJson));

            var isStartRepeat = false;

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


            var tagline = []

            var numberTaglineIn = 0;
            var numberTaglineOut = 0;

            function taglineIn() {

                setTimeout(function () {
                //console.log("tagin")
                numberTaglineIn = 0;

                if(isStartRepeat) {

                    jQuery(".tagline-set").clone().appendTo("#jobiarea-kiosk-container").attr('id', 'toFadeIn');
                    jQuery('#toFadeOut').remove();
                }

                tagline = [
                document.querySelector('#tagline-1'),
                document.querySelector('#tagline-2'),
                document.querySelector('#tagline-3'),
                document.querySelector('#tagline-4')
                ]
                jQuery('.tagline-item').removeClass('animate__bounceOutRight').addClass('animate__bounceInLeft');

                for (let i = 0; i < tagline.length; i++) {
                    // tagline[i].classList.add('', 'animate__bounceInLeft');

                    tagline[i].addEventListener('animationend', (e) => {
                        numberTaglineIn++
                        //console.log(numberTaglineIn)
                        checkNumberCompleted('startOut');
                    });

                }
                }, 500)


            }

            function taglineOut() {
                    //console.log("tagout")


                    setTimeout(function () {
                        numberTaglineIn = 0;
                        jQuery( ".tagline-set" ).clone().appendTo( "#jobiarea-kiosk-container" ).attr('id','toFadeOut');
                        jQuery('#toFadeIn').remove();
                        tagline = [
                            document.querySelector('#tagline-1'),
                            document.querySelector('#tagline-2'),
                            document.querySelector('#tagline-3'),
                            document.querySelector('#tagline-4')
                        ]
                        jQuery('.tagline-item').removeClass('animate__bounceInLeft').addClass('animate__bounceOutRight');
                        for (let i = 0; i < tagline.length; i++) {


                            tagline[i].addEventListener('animationend', (e) => {
                                numberTaglineIn++
                                //console.log(numberTaglineIn)
                                checkNumberCompleted('startIn');
                            });

                        }

                    }, 1500)

            }


            function checkNumberCompleted(toNext){
                if(numberTaglineIn >= tagline.length){
                    //console.log(toNext)
                    if(toNext == "startOut"){
                        taglineOut()
                    }else{
                        isStartRepeat =true;
                        taglineIn()
                    }

                }
            }

            taglineIn()



        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let date = document.getElementById('mDateKiosk')
                let time = document.getElementById('mTimeKiosk')

                moment().locale()
                date.innerHTML = moment().format('dddd, Do MMMM YYYY')
                setInterval(() => {
                    time.innerHTML = moment().format('H:mm:ss')
                }, 1000);
            })

            $(function () {

// Initialize KioskBoard (default/all options)
                KioskBoard.init({
                    /*!
                    * Required
                    * An Array of Objects has to be defined for the custom keys. Hint: Each object creates a row element (HTML) on the keyboard.
                    * e.g. [{"key":"value"}, {"key":"value"}] => [{"0":"A","1":"B","2":"C"}, {"0":"D","1":"E","2":"F"}]
                    */
                    //keysArrayOfObjects: null,

                    /*!
                    * Required only if "keysArrayOfObjects" is "null".
                    * The path of the "kioskboard-keys-${langugage}.json" file must be set to the "keysJsonUrl" option. (XMLHttpRequest to get the keys from JSON file.)
                    * e.g. '/Content/Plugins/KioskBoard/dist/kioskboard-keys-english.json'
                    */
                    keysJsonUrl: '/js/public-vendors/kioskboard-keys-english.json',

                    /*
                    * Optional: An Array of Strings can be set to override the built-in special characters.
                    * e.g. ["#", "$", "%", "+", "-", "*"]
                    */
                    //keysSpecialCharsArrayOfStrings: null,

                    /*
                    * Optional: An Array of Numbers can be set to override the built-in numpad keys. (From 0 to 9, in any order.)
                    * e.g. [1, 2, 3, 4, 5, 6, 7, 8, 9, 0]
                    */
                    //keysNumpadArrayOfNumbers: null,

                    // Optional: (Other Options)

                    // Language Code (ISO 639-1) for custom keys (for language support) => e.g. "de" || "en" || "fr" || "hu" || "tr" etc...
                    language: 'en',

                    // The theme of keyboard => "light" || "dark" || "flat" || "material" || "oldschool"
                    theme: 'light',

                    // Uppercase or lowercase to start. Uppercased when "true"
                    capsLockActive: true,

                    /*
                    * Allow or prevent real/physical keyboard usage. Prevented when "false"
                    * In addition, the "allowMobileKeyboard" option must be "true" as well, if the real/physical keyboard has wanted to be used.
                    */
                    allowRealKeyboard: false,

                    // Allow or prevent mobile keyboard usage. Prevented when "false"
                    allowMobileKeyboard: false,

                    // CSS animations for opening or closing the keyboard
                    cssAnimations: true,

                    // CSS animations duration as millisecond
                    cssAnimationsDuration: 360,

                    // CSS animations style for opening or closing the keyboard => "slide" || "fade"
                    cssAnimationsStyle: 'slide',

                    // Allow or deny Spacebar on the keyboard. The Spacebar will be passive when "false"
                    keysAllowSpacebar: true,

                    // Text of the space key (Spacebar). Without text => " "
                    keysSpacebarText: 'Space',

                    // Font family of the keys
                    keysFontFamily: 'sans-serif',

                    // Font size of the keys
                    keysFontSize: '22px',

                    // Font weight of the keys
                    keysFontWeight: 'normal',

                    // Size of the icon keys
                    keysIconSize: '25px',

                    // Scrolls the document to the top of the input/textarea element. Prevented when "false"
                    autoScroll: false,
                });

                KioskBoard.run('.js-num-virtual-keyboard');


                $('#online-btn').on('click', function () {
                    $('#onlineModal').modal('show')

                })


                $('#onlineModal').on('shown.bs.modal', function (e) {

                    $('.modal-kiosk .step-state').hide();
                    $('.modal-kiosk .step-state#init-state').show();



                })

                $('#online-input-phone').on('click', function () {
                    activateInputPhoneMode();
                })

                $('#online-barcode-input').on('click', function () {
                    activateBarcodeScan();
                })


                function activateInputPhoneMode(){
                    $('.modal-kiosk .step-state').hide();
                    $('#onlineModal #init-state').hide();
                    $('#onlineModal #inputphone-state').show();
                    $("#submit-phone").prop("disabled", true);
                    $('#phone').removeClass('active').addClass('active');
                    setTimeout(function () {
                        $('#phone').val('').focus();
                    },300);
                }

                function activateBarcodeScan(){

                    $('.modal-kiosk .step-state').hide();
                    $('#onlineModal #init-state').hide();

                    $('#onlineModal #barcodeinput-state').show();

                    setTimeout(function () {
                        $('#barcode-input-form').val('').focus();
                        //$('#barcode-input-form').val('puspakeranol-eyJpdiI6ImoxbkpoY1Q0SlFSQjJNTnJKeDB4aGc9PSIsInZhbHVlIjoiWkhaRG40QlhDTkVod0g5aXA2MEgzUT09IiwibWFjIjoiM2VjZDYzOWNmZGIyNzU5YmQ2YTkxOTc3Mjk1ZjU3NDliMzcwNTk1NjU3YWE3ZDVmNDdhZTgwODEwNWFmMjQzZiIsInRhZyI6IiJ9');
                    },300);


                    // setTimeout(function () {
                    //     $( "#barcodeSubmitCode" ).submit();
                    // },3000);

                    //process

                }

                $( "#barcodeSubmitCode" ).on( "submit", function(e) {
                    e.preventDefault();
                    barcodeOnSubmit(true)
                    // return;
                    var action = '{{ route('kiosk.submit_barcode') }}';


                    axios.post(action, {
                        barcode: $('#barcode-input-form').val()
                    })
                        .then(function (response) {
                            // console.log(response.data)

                            if (response.data.success == 1) {
                                statePrint(response.data.noAntrian,response.data.pelayanan);
                                // alert(response.data.message)
                                //this is not found data
                                // onLoadingKioskButton('off', 'online');
                                // statePrint(response.data.noAntrian,response.data.pelayanan);
                                return
                            } else {
                                stateNotFoundData(response.data,"barcode");

                            }
                        })
                        .catch(function (error) {
                            stateNotFoundData({
                                "title":"Error",
                                "message":"Terjadi kesalahan pada sistem, silahkan ulangi",
                            },"barcode");
                            // swal("Ups!","Terjadi kesalahan silahkan ulangi",'error');
                            // activateBarcodeScan();
                            // alert('Terjadi kesalahan silahkan ulangi')
                        }).then(function () {
                            barcodeOnSubmit(false)
                        });



                  // do something
                });

                function barcodeOnSubmit(active){
                    //hide state and show loading
                    if(active) {
                        $('.spinnerkiosk-barcode-scan').show()
                        $('.illustrator-barcode-scan').hide()
                    }else{
                        $('.spinnerkiosk-barcode-scan').hide()
                        $('.illustrator-barcode-scan').show()
                        setTimeout(function () {
                            $('#barcode-input-form').val('').focus();
                            //$('#barcode-input-form').val('puspakeranol-eyJpdiI6ImoxbkpoY1Q0SlFSQjJNTnJKeDB4aGc9PSIsInZhbHVlIjoiWkhaRG40QlhDTkVod0g5aXA2MEgzUT09IiwibWFjIjoiM2VjZDYzOWNmZGIyNzU5YmQ2YTkxOTc3Mjk1ZjU3NDliMzcwNTk1NjU3YWE3ZDVmNDdhZTgwODEwNWFmMjQzZiIsInRhZyI6IiJ9');
                        },300);
                    }
                }

                function stateNotFoundData(response,source) {
                    $('.modal-kiosk .step-state').hide();
                    $('.modal-kiosk .step-state#error-state').show();
                    $('#error_title').text('').text(response.title);
                    $('#error_desc').html('').html(response.message);
                    $('#retry-input-online').data('backto',source);

                }

                function statePrint(noAntrian,pelayanan) {
                    $('.modal-kiosk .step-state').hide();
                    $('.modal-kiosk .step-state.print-state').show();
                    $('.modal-kiosk .step-state.print-state .print-no-out').text('-')
                    $('.modal-kiosk .step-state.print-state .print-no-out').text(noAntrian)

                    printNoAntrian(noAntrian,pelayanan);


                    var timeleft = 5;
                    var downloadTimer = setInterval(function () {
                        if (timeleft <= 0) {
                            clearInterval(downloadTimer);

                            location.reload();
                        } else {
                            $('.countdown-print').text("Menutup jendela pada...(" + timeleft + "s)")

                        }
                        timeleft -= 1;
                    }, 1000)
                }

                function printNoAntrian(token,pelayanan) {

                    setTimeout(function (){
                        moment().locale()

                        $('#print-date').text(`${moment().format('dddd, Do MMMM YYYY')} - ${moment().format('H:mm:ss')}`)
                        $('#print-token').text(token)
                        $('#print-layanan').text(pelayanan)

                        window.print();
                        return;
                    },1000)

                }

                function onLoadingKioskButton(status, location) {
                    if (status == 'on') {
                        $('.spinnerkiosk-' + location).show()
                        $('.list-layanan-active').hide();
                    } else {
                        $('.spinnerkiosk-' + location).hide()
                        $('.list-layanan-active').show();
                    }

                    if (location == 'online') {
                        setTimeout(function () {
                            $('#phone').focus();
                        }, 500);


                    }

                }

                //submit online

                document.getElementById("phone").addEventListener("change", (e) => {
                    var value = document.getElementById("phone").value;

                    if (value.substr(0, 1) != "0" || value.length <= 0) {
                        $('.phonenot0').show()
                        $("#submit-phone").prop("disabled", true);
                    } else {
                        $('.phonenot0').hide()
                        $("#submit-phone").prop("disabled", false);
                    }


                    //console.log(document.getElementById("phone").value);
                });


                $('#submit-phone').on('click', function (e) {

                    //e.preventDefault();
                    //this.prop( "disabled", true );
                    e.preventDefault()
                    let action = $(this).data('href');
                    let phone = $('#phone').val();

                    if (phone == "") {
                        onLoadingKioskButton('off', 'online');
                        swal("Ups!","Masukkan No Handphone",'warning');

                        return
                    }
                    if (phone.substr(0, 1) != '0') {
                        // console.log(phone.substr(0,1))
                        swal("Ups!","No Handphone harus diawali dengan 0",'warning');
                        // alert('No Handphone harus diawali dengan 0')
                        $('#phone').val('');

                        onLoadingKioskButton('off', 'online');
                        return
                    }


                    //$('.modal-kiosk .step-state').hide();
                    // $('.modal-kiosk .step-state#error-state').show();

                    phoneOnSubmit(true)

                    axios.post(action, {
                        phone: phone
                    })
                        .then(function (response) {

                            if (response.data.success == 1) {
                                //this is not found data
                                statePrint(response.data.noAntrian,response.data.pelayanan);
                                return
                            } else {
                                stateNotFoundData(response.data,"handphone");
                            }
                        })
                        .catch(function (error) {
                            stateNotFoundData({
                                "title":"Error",
                                "message":"Terjadi kesalahan pada sistem, silahkan ulangi",
                            },"handphone");

                        }).then(function () {
                            phoneOnSubmit(false)
                        });
                })

                function phoneOnSubmit(active){
                    //hide state and show loading
                    if(active) {
                        $('.spinnerkiosk-phone-submit').show()
                        $('.input-phone-area').hide()
                    }else{
                        $('.spinnerkiosk-phone-submit').hide()
                        $('.input-phone-area').show()
                        setTimeout(function () {
                            $('#phone').val('').focus();
                            //$('#barcode-input-form').val('puspakeranol-eyJpdiI6ImoxbkpoY1Q0SlFSQjJNTnJKeDB4aGc9PSIsInZhbHVlIjoiWkhaRG40QlhDTkVod0g5aXA2MEgzUT09IiwibWFjIjoiM2VjZDYzOWNmZGIyNzU5YmQ2YTkxOTc3Mjk1ZjU3NDliMzcwNTk1NjU3YWE3ZDVmNDdhZTgwODEwNWFmMjQzZiIsInRhZyI6IiJ9');
                        },300);
                    }
                }

                $('.modal-kiosk').on('click', '.item-pelayanan', function (e) {

                    //e.preventDefault();
                    let action = $('#kiosk-submit-url').val();
                    let pelayananId = $(this).data('pelayanan');

                    onLoadingKioskButton('on', 'offline');
                    axios.post(action, {
                        pelayanan_id: pelayananId
                    })
                        .then(function (response) {

                            onLoadingKioskButton('off', 'offline');
                            // return
                            if (response.data.success == 1) {
                                //this is not found data
                                statePrint(response.data.noAntrian,response.data.pelayanan);
                            }else{
                                console.log(response)
                                swal("Ups!",response.data.message,'warning')

                            }



                        })
                        .catch(function (error) {
                            swal("Ups!","Terjadi kesalahan silahkan ulangi",'error');

                            //alert('Terjadi kesalahan silahkan ulanagi')

                        }).then(function () {
                        onLoadingKioskButton('off', 'offline');
                    })
                })

                $('#retry-input-online').on('click', function () {
                    if($(this).data('backto') == "barcode"){
                        activateBarcodeScan();

                    }else{
                        activateInputPhoneMode()
                    }

                    // $('#phone').focus();

                })

                var templatelayanan = function (id, title) {
                    return `<span class="col-md-3 text-center item-pelayanan text-uppercase ml-4 py-5 pt-5 rounded"
                            data-pelayanan="${id}">${title}</span>`;
                }

                $('#offline-btn').on('click', function () {
                    $('#offlineModal').modal('show')
                    $('#pick-layanan-state').hide();
                    onLoadingKioskButton('on', 'offline');
                    $('.list-layanan-active').empty();

                    axios.get('{{ route('pelayanan.list.json') }}')
                        .then(function (response) {
                            console.log(response.data);

                            onLoadingKioskButton('off', 'offline');
                            if (response.data.length <= 0) {
                                $('.list-layanan-active').append('<span class="text-red-pasker-light">Pelayanan tidak ditemukan, atau telah mecapai limit. <br/>silahkan hubungi staff</span>')
                            }
                            for (var i = 0; i < response.data.length; i++) {
                                $('.list-layanan-active').append(templatelayanan(response.data[i].id, response.data[i].title))
                            }
                        })
                        .catch(function (error) {
                            // handle error

                            onLoadingKioskButton('off', 'offline');
                            $('.list-layanan-active').append('<span class="text-red-pasker-light">Terjadi kesalahan, silahkan ulangi</span>')
                            return

                        })
                        .then(function () {
                            // always executed
                        });
                })

                $('#offlineModal').on('shown.bs.modal', function (e) {
                    // $('#input-phone-online').focus();

                    //get pelayanan active


                    $('.step-state').hide()
                    $('#pick-layanan-state').show()

                })


            });




        </script>
    @endpush
@endsection

@section('footer')
    <footer class="hidden-print mt-n5">
        <div class="container container-footer">
            <div class="pt-4 mb-4 pt-md-5 border-top">
                <div class="row mb-3">
                    <div class="col-6 col-md">
                        <img class="mb-2" src="/assets/logo_blue.png" alt="" width="200">
                        <div class="link-site pl-3 mt-3">
                            <a class="d-block mb-2" href="https://kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>Kemnaker.go.id</u></a>
                            <a class="d-block" href="https://karirhub.kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>#KARIRhub</u></a>
                        </div>


                    </div>
                    <div class="col-6 col-md text-secondary">
                        <h5 class="text-pasker poppinsmedium">PASKER.ID</h5>
                        <p class="text-orange-pasker-light" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
                        <p>
                            Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                        </p>
                        <div class="row">
                            <div class="col-md-7">
                                <i class="bi bi-telephone text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;0812 8108 9843<br/>
                                <i class="bi bi-envelope text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;layananpuspaker@kemnaker.go.id
                            </div>
                            <div class="col-md-5 text-right">
                                <div class="footer-social" style="font-size: 1.4rem">
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-twitter"></i></a>
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-facebook"></i></a>
                                    <a target="_blank" class="ml-3 d-inline-block text-pasker" href="https://www.instagram.com/pusatpasarkerja/"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </footer>
@endsection
