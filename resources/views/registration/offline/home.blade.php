@extends('layouts.bootstrap_public')
@section('content')
<div class="container-fluid hero-home pb-5">
    <div class=" d-flex justify-content-between mt-3">
        <div class="">
            <div class="row">
                <div class="col-6 ml-5 pt-3">
                    <img class="img-fluid" src="/assets/logo_light.png" alt="">
                </div>
            </div>
        </div>
        <div class="text-right mr-5">
            <div id="mDate" class="text-uppercase "></div>
            <div id="mTime" class=""></div>
        </div>
    </div>
    <div class="row text-center mt-n-3">
        <div class="col-12 ">
            <p class="m-0 text-uppercase" style="font-size: 1rem">Selamat Datang di</p>
            <p class="m-0 text-uppercase" style="font-size: 1rem">ANTRILAH</p>
            <h1>Pasker ID</h1>
        </div>
    </div>

    <div class="container container-content-kiosk mt-5">
        <div class="card-deck mb-3 text-center text-black-50">

            <div id="online-btn" class="card mb-4 box-shadow kiosk-btn-home px-5 py-3">
                <div class="row justify-content-center mb-4 mt-3">
                    <div class="col-8">
                        <img class="img-fluid" src="/assets/online-icon.png" alt="">
                    </div>
                </div>
                <h2 class="text-body">Antrian Online</h2>
                <p>Tekan disini jika anda <strong>SUDAH</strong> melakukan registrasi via online</p>
            </div>

            <div id="offline-btn" class="card mb-4 box-shadow kiosk-btn-home px-5 py-3">
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


    <img class="mascot-bottom-kiosk mascot-bottom" src="/assets/pose01_preview_small.png">

</div>


<!-- Modal -->
<div class="modal fade modal-kiosk" id="onlineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5">
            <div class="modal-body text-center">

                <div class="row text-center justify-content-center spinnerkiosk-online" style="display: none">
                    <div class=" spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="py-5 step-state" id="init-state">
                    <h2 class="text-center text-pasker ">Masukkan No. Handphone</h2>
                    <p class="text-center">Masukkan No. Handphone yang anda daftarkan pada saat registrasi online</p>
                    <div class="alert alert-danger phonenot0" style="display: none;font-size: 0.9rem">
                        No Handphone harus diawali dengan angka 0
                    </div>
                    <div class="input-phone-area">
                        <input data-kioskboard-type="numpad" type="number" id="phone" class="form-control js-num-virtual-keyboard"
                            placeholder="Masukkan No Handphone diawali">
{{--                        <div class="input-group input-group w-100 ">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text" id="inputGroup-sizing-sm" >+62</span>--}}
{{--                            </div>--}}
{{--                            --}}
{{--                        </div>--}}
                    </div>

                    <button id="submit-phone" disabled data-href="{{route('kiosk.submit_phone')}}" class="btn btn-pasker-main btn-lg text-white mt-4">SUBMIT</button>
                </div>


                <div class="py-5 step-state" id="error-state" style="display: none">
                    <h2 class="text-center text-danger ">Tidak Ditemukan</h2>
                    <p>No Handphone Anda tidak ditemukan pada jadwal hari ini.</p>
                    <i class="bi bi-emoji-frown text-muted"></i>

                    <p class="text-muted">Pastikan No. Handphone yang Anda masukkan benar dan telah terjadwal hari ini.<br>
                    Atau silahkan ambil Antrian Offline</p>
                    <button id="retry-input-phone" class="btn btn-pasker-main text-white mt-4">COBA KEMBALI</button>
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
<div class="modal fade modal-kiosk" id="offlineModal" tabindex="-1" aria-hidden="true">
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
                        <div class="row text-center justify-content-center spinnerkiosk-offline" style="display: none">
                            <div class=" spinner-border text-success" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="row text-center justify-content-center list-layanan-active">
                            @foreach ($pelayanan as $item)

                            <span class="col-md-3 text-center item-pelayanan text-uppercase ml-4 py-5 pt-5 rounded"
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


@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let date = document.getElementById('mDate')
        let time = document.getElementById('mTime')

        moment().locale()
        date.innerHTML = moment().format('dddd, Do MMMM YYYY')
        setInterval(() => {
            time.innerHTML = moment().format('H:mm:ss')
        }, 1000);
    })

    $(function() {

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
            autoScroll: true,
        });

        KioskBoard.run('.js-num-virtual-keyboard');


        $('#online-btn').on('click',function(){
            $('#onlineModal').modal('show')

        })


        $('#onlineModal').on('shown.bs.modal', function (e) {
            $( "#submit-phone" ).prop( "disabled", true );
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state#init-state').show();
            $('#phone').removeClass('active').addClass('active');
            $('#phone').val('').focus();


        })

        function stateNotFoundData(){
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state#error-state').show();
        }

        function statePrint(noAntrian){
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state.print-state').show();
            $('.modal-kiosk .step-state.print-state .print-no-out').text('-')
            $('.modal-kiosk .step-state.print-state .print-no-out').text(noAntrian)

            var timeleft = 5;
            var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);

                location.reload();
            } else {
                $('.countdown-print').text("Menutup jendela pada...("+timeleft + "s)")

            }
            timeleft -= 1;
            }, 1000)
        }

        function onLoadingKioskButton(status,location) {
            if(status=='on'){
                $('.spinnerkiosk-'+location).show()
                $('.list-layanan-active').hide();
            }else{
                $('.spinnerkiosk-'+location).hide()
                $('.list-layanan-active').show();
            }

            if(location == 'online'){
                setTimeout(function () {
                    $('#phone').focus();
                }, 500);



            }

        }

        //submit online

        document.getElementById("phone").addEventListener("change", (e) => {
            var value = document.getElementById("phone").value;

            if(value.substr(0,1)!="0" || value.length <=0){
                $('.phonenot0').show()
                $( "#submit-phone" ).prop( "disabled", true );
            }else{
                $('.phonenot0').hide()
                $( "#submit-phone" ).prop( "disabled", false );
            }


            //console.log(document.getElementById("phone").value);
        });


        $('#submit-phone').on('click',function(e){

            //e.preventDefault();
            //this.prop( "disabled", true );
            let action = $(this).data('href');
            let phone = $('#phone').val();
            //todo: ganti dengan notify biar lebih gede tombol nya
            if(phone==""){
                onLoadingKioskButton('off','online');
                alert('Masukkan No Handphone')
                return
            }
            if(phone.substr(0,1)!='0'){
                // console.log(phone.substr(0,1))

                alert('No Handphone harus diawali dengan 0')
                $('#phone').val('');

                onLoadingKioskButton('off','online');
                return
            }


            //$('.modal-kiosk .step-state').hide();
            // $('.modal-kiosk .step-state#error-state').show();

            onLoadingKioskButton('on','online');
            axios.post(action, {
                phone: phone
            })
            .then(function (response) {
                //todo: handle ajax error with SAlert

                // return
                if(response.data.success == 1){
                    //this is not found data
                    onLoadingKioskButton('off','online');
                    statePrint(response.data.noAntrian);
                    return
                }else{
                    onLoadingKioskButton('off','online');
                    stateNotFoundData();
                    return
                }
            })
            .catch(function (error) {
                alert('Terjadi kesalahan silahkan ulangi')
                onLoadingKioskButton('off','online');

            }).then(function (){
                onLoadingKioskButton('off','online');
            });
        })

        $('.modal-kiosk').on('click','.item-pelayanan',function(e){

            //e.preventDefault();
            let action = $('#kiosk-submit-url').val();
            let pelayananId = $(this).data('pelayanan');

            onLoadingKioskButton('on','offline');
            axios.post(action, {
                pelayanan_id: pelayananId
            })
            .then(function (response) {
                //todo: handle ajax error with SAlert
                onLoadingKioskButton('off','offline');
                // return
                if(response.data.success == 1){
                    //this is not found data
                    statePrint(response.data.noAntrian);
                }

            })
            .catch(function (error) {
                alert('Terjadi kesalahan silahkan ulanagi')
                console.log(error);
                console.log(error.response.data.message)
            }).then(function (){
                onLoadingKioskButton('off','offline');
            })
        })

        $('#retry-input-phone').on('click',function(){
            $( "#submit-phone" ).prop( "disabled", true );
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state#init-state').show();
            $('#phone').val('');
            $('#phone').removeClass('active').addClass('active');
            setTimeout(function(){
                $('#phone').focus();
            }, 500);

            // $('#phone').focus();

        })

        var templatelayanan = function (id,title){
            return `<span class="col-md-3 text-center item-pelayanan text-uppercase ml-4 py-5 pt-5 rounded"
                            data-pelayanan="${id}">${title}</span>`;
        }

        $('#offline-btn').on('click',function(){
            $('#offlineModal').modal('show')
            $('#pick-layanan-state').hide();
            onLoadingKioskButton('on','offline');
            $('.list-layanan-active').empty();

            axios.get('{{ route('pelayanan.list.json') }}')
              .then(function (response) {
                  onLoadingKioskButton('off','offline');
                  if(response.data.length <= 0){
                       $('.list-layanan-active').append('<span class="text-red-pasker-light">Pelayanan tidak ditemukan</span>')
                  }
                  for (var i = 0; i < response.data.length; i++) {
                      $('.list-layanan-active').append(templatelayanan(response.data[i].id,response.data[i].title))
                  }
              })
              .catch(function (error) {
                // handle error

                  onLoadingKioskButton('off','offline');
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


            $('#pick-layanan-state').show()

        })




    });



</script>
@endsection
