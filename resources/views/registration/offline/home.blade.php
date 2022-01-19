@extends('layouts.bootstrap_public')

{{-- todo: add loading scene --}}

@section('content')
<div class="container-fluid hero-home pb-5">
    <div class=" d-flex justify-content-between mt-3">
        <div class="">
            <div class="row">
                <div class="col-6 ml-5">
                    <img class="img-fluid" src="/assets/logo_light.png" alt="">
                </div>
            </div>
        </div>
        <div class="text-right mr-5">
            <div id="mDate" class="text-uppercase "></div>
            <div id="mTime" class="text-warning"></div>
        </div>
    </div>
    <div class="row text-center ">
        <div class="col-12 ">
            <p class="m-0 text-uppercase" style="font-size: 0.8rem">Selamat Datang di</p>
            <h3>PUSAT PASAR KERJA</h3>
        </div>
    </div>

    <div class="container container-content-kiosk mt-5">
        <div class="card-deck mb-3 text-center text-black-50">

            <div id="online-btn" class="card mb-4 box-shadow kiosk-btn-home px-5 py-3">
                <i class="bi bi-globe"></i>
                <h2 class="text-body">Antrian Online</h2>
                <p>Tekan disini jika anda <strong>SUDAH</strong> melakukan registrasi via online</p>
            </div>

            <div id="offline-btn" class="card mb-4 box-shadow kiosk-btn-home px-5 py-3">
                <i class="bi bi-bank" id="offline"></i>
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

                <div class="py-5 step-state" id="init-state">
                    <h2 class="text-center text-pasker ">Masukkan No. Handphone</h2>
                    <p class="text-center">Masukkan No. Handphone yang anda daftarkan pada saat registrasi online</p>
                    <input type="number" id="phone" class="form-control w-100"
                        placeholder="Masukkan No Handphone">
                    <button id="submit-phone" data-href="{{route('kiosk.submit_phone')}}" class="btn btn-pasker-main btn-lg text-white mt-4">SUBMIT</button>
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
                        <div class="row text-center justify-content-center">
                            @foreach ($pelayanan as $item)
                            
                            <span class="col-md-3 text-center item-pelayanan text-uppercase ml-4 py-5 pt-5"
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
    
        $('#online-btn').on('click',function(){
            $('#onlineModal').modal('show')
            
        })

        $('#onlineModal').on('shown.bs.modal', function (e) {
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state#init-state').show();
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

            var timeleft = 10;
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

        //submit online
        $('#submit-phone').on('click',function(e){

            //e.preventDefault();
            let action = $(this).data('href');
            let phone = $('#phone').val();
            //todo: ganti dengan notify biar lebih gede tombol nya
            if(phone==""){
                alert('Masukkan No Handphone')
                return
            }
            //todo : disable enable
            
            //$('.modal-kiosk .step-state').hide();
            // $('.modal-kiosk .step-state#error-state').show();
            axios.post(action, {
                phone: phone
            })
            .then(function (response) {
                //todo: handle ajax error with SAlert
                console.log(response.data);
                // return
                if(response.data.success == 1){
                    //this is not found data
                    statePrint(response.data.noAntrian);
                    return
                }else{
                    stateNotFoundData();
                    return
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        })

        $('.item-pelayanan').on('click',function(e){

            //e.preventDefault();
            let action = $('#kiosk-submit-url').val();
            let pelayananId = $(this).data('pelayanan');

            
            axios.post(action, {
                pelayanan_id: pelayananId
            })
            .then(function (response) {
                //todo: handle ajax error with SAlert
                console.log(response.data);
                // return
                if(response.data.success == 1){
                    //this is not found data
                    statePrint(response.data.noAntrian);
                    return
                }
            })
            .catch(function (error) {
                console.log(error);
                console.log(error.response.data.message)
            });
        })


        $('#retry-input-phone').on('click',function(){
            $('.modal-kiosk .step-state').hide();
            $('.modal-kiosk .step-state#init-state').show();
            $('#phone').val('').focus();
            // $('#phone').focus();

        })
        
        $('#offline-btn').on('click',function(){
            $('#offlineModal').modal('show')
        })

        $('#offlineModal').on('shown.bs.modal', function (e) {
            // $('#input-phone-online').focus();
            $('#pick-layanan-state').show()
            
        })

   
    });



</script>
@endsection