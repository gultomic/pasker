@extends('layouts.bootstrap_public')
@section('content')
<div class="container-fluid px-0">
<div class="hero-home pb-5" style="padding-bottom: 7rem !important;">
    <div class="row justify-content-center justify-content-md-start">
        <div class="col-5 col-lg-2 pt-4 mx-5 text-center">
            <img class="img-fluid" src="/assets/logo_light.png" alt="">

        </div>
    </div>
    <div class="row d-block d-md-none mt-3">
         <h1 class="text-center pasker-logo-home " style="font-size: 2rem">
                    PASKER.ID
        </h1>

    </div>
    <div class="row pt-2 justify-content-center ">

        <div class="col-10 col-lg-4 order-md-2 pb-5 mt-3 mt-lg-n4 text-center ">
            <h1 class="head_grobold">Malas Antri ?</h1>
            <div class="subhead_page rounded">
                <span class="grobold">Daftar online aja</span>
            </div>

            @if (session('exist_request_date'))
            <div class="alert alert-warning" role="alert" style="font-size: 0.9rem">
                <strong>Pendaftaran Tidak Berhasil</strong>
                <p>Anda telah memiliki jadwal pada hari <br/>{{ session('exist_request_date') }}.<br/>Silahkan lakukan kunjungan terlebih dahulu</p>
            </div>
            @endif

            @if (session('client_error'))
            <div class="alert alert-warning" role="alert" style="font-size: 0.9rem">
                <strong>Pendaftaran Tidak Berhasil</strong>
                <p>{!!  nl2br(session('client_error')) !!}</p>
            </div>
            @endif

            @if(session('flash_error'))
            <div class="alert alert-warning" role="alert" style="font-size: 0.9rem">
                <strong>Pendaftaran Tidak Berhasil</strong>
                <p>{{ session('flash_error') }}</p>
            </div>
            @endif
            <form action="{{ route('registration.online.submit') }}" id="registration_form" class="text-left" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" id="nama-lengkap" name="nama" autocomplete="off"
                        required="true" value="{{ old('nama', "") }}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No. Handphone *</label>
                    <input type="number" class="form-control" id="no-handphone" name="phone" autocomplete="off"
                        required="true" value="{{ old('phone', "") }}">
{{--                    <div class="input-group input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text" id="inputGroup-sizing-sm" style="font-size: 0.8rem">+62</span>--}}
{{--                        </div>--}}
{{--                        <input type="number" class="form-control" id="no-handphone" name="phone" autocomplete="off"--}}
{{--                        required="true">--}}
{{--                    </div>--}}

                </div>

                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                           value="{{ old('email', "") }}"
                        >
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pilih Pelayanan</label>
                    <select class="custom-select d-block w-100" id="pelayanan_input" name="pelayanan">
                        <option value="">--Pilih Pelayanan--</option>
                        @foreach ( $pelayanan as $item )
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">

                    <div class="form-row">
                        <div class="col-md-8 ">
                            <label for="validationCustom01">Pilih Jadwal</label>
                            <input type="text" class="form-control" id="date-picker" name="tanggal" required>
                        </div>
                        <div class="col-md-4 ">
                            <label for="validationCustom02">&nbsp;</label>
                            <div class="input-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="bi bi-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" id="time-picker" name="jam">
                            </div>
                        </div>

                    </div>
                    <div id="statushour" class="alert alert-warning" role="alert" style="font-size: 0.9rem;display: none">

                    </div>


                </div>



                <button type="submit" class="btn bg-yellow-pasker btn-lg mt-3 mb-3 w-100 ">Daftar
                    &nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-right"></i>
                </button>
                <div class="row mt-2">
                    <div class="col-md-6">
{{--                        <a class="d-block text-white" href="#!" onclick="document.getElementById('about-pasar-kerja').scrollIntoView({behavior: 'smooth'});--}}
{{--                            ">--}}
{{--                            <u>Alur Pelayanan</u>--}}
{{--                        </a>--}}
                        <a class="d-block text-white" href="#!" data-toggle="modal" data-target="#modal-alur">
                            <u>Alur Pelayanan</u>
                        </a>

                    </div>
                    <div class="col-md-4 ml-auto text-right">
                        <a class="d-block text-white" style="" href="#!" data-toggle="modal" data-target="#disclaimer-modal">
                            <i class="bi bi-exclamation-circle-fill text-white"></i>&nbsp;<u>Disclaimer</u>
                        </a>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-lg-5 order-md-1  offset-lg-1 pb-4 mt-lg-5 text-right">
            <h1 class="mt-0 mb-2 pasker-logo-home text-left ml-5 d-none d-md-block">
                        PASKER.ID
            </h1>

            <!-- <img class="position-absolute" style="bottom:0;right:0;" src="/assets/young-man.png" alt=""> -->
            <div class="row jobi-mascot-home mt-0 mt-lg-3">
                <img class="img-fluid text-right" src="/assets/pose01_preview_small.png" alt="">
    {{--                <div class="tagline-pasker-home text-left">--}}
    {{--                    <span class="d-block">#SIAPKerja</span>--}}
    {{--                    <span class="d-block">#KarirHub</span>--}}
    {{--                    <span class="d-block">#TalentHub</span>--}}
    {{--                    <span class="d-block">#GetAJobLiveBetter</span>--}}
    {{--                </div>--}}
                <small class="namajobilg namajobi d-none d-md-block" style="color: #eef9f6">JOBI <br/>Maskot Pasker.ID</small>
                <small class="namajobismall namajobi d-block d-md-none" style="color: #eef9f6; ">JOBI <br/>Maskot Pasker.ID</small>
            </div>
            <div class="text-center pt-4 tagline-home-three">
            <div class="row justify-content-center mb-5">
                <div class="col">
                    <span class="">#SIAPKerja</span>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col ">
                    <span class="">#KarirHub</span>
                </div>
                <div class="col">
                    <span class="">#TalentHub</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <span class="">#GetAJobLiveBetter</span>
                </div>
            </div>
            </div>


        </div>

    </div>
</div>

{{--<div class="container mx-5 pb-5 border-bottom" id="alur-antrian">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-lg-8 text-center">--}}

{{--            <img src="{{ asset('assets/alur-pelayanan.jpeg') }}" alt="" class="img-fluid">--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

<div class="row text-center mx-lg-5 px-5 py-lg-5 py-2" id="about-pasar-kerja">
        <div class="col-lg-6">
            <img class="img-fluid" src="/assets/ibuida.png" alt="">
        </div>
        <div class="col-lg-6 text-left">
            <h3 class="text-pasker mb-3 "> Selamat Datang di <strong class="poppinsmedium">PASKER.ID</strong></h3>
            <p>Pasker ID adalah tempat buat teman-teman Jobers mendapatkan informasi lowongan dari seluruh Indonesia sesuai dengan keahlian atau skill yang dimiliki, ataupun buat teman-teman employer menemukan calon employee yang berkualitas dan kapabel.</p>
            <p>Lewat Karirhub, Pasker ID menawarkan berbagai informasi pasar kerja yang dapat teman-teman akses dengan mudah dan gratis! </p>
            <p>Selain layanan informasi pasar kerja, Pasker ID juga melayani teman-teman Jobers untuk menemukan potensi diri, jadi teman-teman Jobers lebih mudah menemukan pekerjaan yang cocok. Dengan informasi lowongan yang terverifikasi (no hoax) dan tersebar di seluruh Indonesia, serta dengan layanan dari petugas yang professional, Pasker ID siap membantu teman-teman mendapatkan pekerjaan yang sesuai dengan potensi dan skill teman-teman.</p>
            <p class="text-orange-pasker-light" style="text-transform:uppercase;font-size:0.8em;margin-bottom:0 !important;">Dr.
                Dra. Hj. Ida Fauziyah, M.Si</p>
            <p class="text-secondary" style="font-size:0.8em;">Menteri Ketenagakerjaan Republik Indonesia</p>
        </div>

</div>





<!-- Modal -->
<div class="modal fade modal-kiosk" id="modal-alur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " style="font-size: 0.9rem">
                <div class="text-center" id="">
                    <img src="{{ asset('assets/alur-pelayanan.jpeg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade modal" id="disclaimer-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " style="font-size: 0.9rem">
                <div class="" id="">
                    <h2 class="text-center text-pasker mb-4">Disclaimer PASKER.ID</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the
                        industry's standard dummy text ever since the 1500s</p>
                    <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                        has
                        survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                        containing Lorem Ipsum</p>
                    <p>passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions
                        of Lorem Ipsum.</p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the
                        industry's standard dummy text ever since the 1500s</p>
                    <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                        has
                        survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                        containing Lorem Ipsum
                    <p>passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions
                        of Lorem Ipsum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>



    jQuery.datetimepicker.setLocale('id');
    // $('#datetimepicker').on('click',function (){
    //     $('#datetimepicker').datetimepicker('show');
    // })

    var holidays =[];
    var jamloket = JSON.parse(@json($jam_loket));
    var tglmerahDB = JSON.parse(@json($tglMerah));
    var availableQuota = [];

    var tanggalmerah = [];
    var convert = Object.keys(tglmerahDB).map((key) => [Number(key), tglmerahDB[key]]);
    tanggalmerah = convert.map(function(e){
     return {
         tanggal:moment(e[0],'YYYYMMDD').format('YYYY-MM-DD'),
         deskripsi:e[1].deskripsi,
         status:e[1].status
     }
    }).filter(e=>e.status=="CONFIRMED")
    console.log(tanggalmerah)


    var harilibur = jamloket.reduce(function(acc,el,index){
        if(el.libur == 1) {
            acc.push({
                ThLibur:':nth-child('+(index + 1) + ')',
                TdLibur:'.xdsoft_day_of_week'+(index)
            })
        }
        return acc;
    },[])

    var thlibur = harilibur.map(e=>e.ThLibur).join(', ')

    window.minTimeObj = '';
    window.maxTimeObj = '';

    $('#pelayanan_input').on('change',function(){
        $('#date-picker').val('');
        $('#time-picker').val('')
    })

    jQuery('#date-picker').datetimepicker({
        timepicker: false,
        onSelectDate: function (ct,$input) {
            if($('#pelayanan_input').val()==""){
                $('#date-picker').val('');
                alert('Silahkan pilih pelayanan terlebih dahulu')
                return;
            }
            console.log('onchangedatetim');
            console.log('bef')
            console.log("ini"+$('#date-picker').val())
            console.log("ini"+moment($('#date-picker').val(),'DD MMM Y').format('YYYYMMDD'))

            console.log('aff')
            console.log(ct)
            //alert(moment(ct).format('d'))
            //console.log(jamloket[moment(ct).format('d')])
            window.minTimeObj = jamloket[moment(ct).format('d')].jam_buka
            var maxTimeBef = jamloket[moment(ct).format('d')].jam_tutup
            window.maxTimeObj = maxTimeBef.replace(maxTimeBef.substr(maxTimeBef.length - 1), '1')

            getAvailableQuota(moment($('#date-picker').val(),'DD MMM Y').format('YYYYMMDD'),$('#pelayanan_input').val());

            // setTimeout(function () {
            //     $(".xdsoft_time_variant").css({"margin-top": 0});
            // }, 10)
            //jQuery('#time-picker').setOptions({allowTimes: ['09:00']})


        },
        onGenerate: function(ct,$input) {
            var test = moment().add(2,'days').format('YYYYMMDD');
            console.log(test)
            //$(this).find('.xdsoft_date.xdsoft_weekend').remove();
            $('.xdsoft_calendar table thead tr th').filter(thlibur).remove();

            $input.prop('readonly', true);
            var $this = $(this);
            harilibur.forEach(function (day) {
                // $('.xdsoft_calendar table thead tr th'+day.ThLibur).addClass('ThisDayLibur');
                $this.find(day.TdLibur).remove();

            });

        },
        // inline:true,
        format: 'd M Y',
        formatDate:'Y-m-d',
        scrollInput: false,
        //minDate:moment().add(2,'days').format('DD MMM YYYY'),
        minDate:moment().add(1,'days').format('YYYY-MM-DD'),
        maxDate:moment().add(3,'days').format('YYYY-MM-DD'),
        disabledDates:tanggalmerah.map((e)=>e.tanggal)
        //startDate:moment().add(1,'days').format('YYYYMMDD'),

    });

    jQuery('#time-picker').datetimepicker({
        datepicker: false,
        // allowTimes:[
        //  '09:00', '10:00', '11:00','12:00','13:00','14:00','15:00','16:00'
        // ],

        onShow: function (ct) {
            console.log(minTimeObj)
            console.log(maxTimeObj)


            this.setOptions({
            minTime: window.minTimeObj,
            maxTime: window.maxTimeObj,
            })

            setTimeout(function(){
                   $(".xdsoft_time_variant").css({"margin-top": 0});
            }, 10)

        },
        // minTime: minTime,
        // maxTime:maxTime,
        format: 'H:i',

        onGenerate: function(ct,$input) {




            $input.prop('readonly', true);
            var $this = $(this);
            $('[data-hour="12"]').remove();
            var noQuota  = availableQuota.filter(function(obj) {
              return obj.quota <= 0;
            });

            if(noQuota.length > 0){
                noQuota.forEach(function (obj){
                    jQuery('[data-hour="'+obj.jam+'"]').remove();
                })
            }

            if((noQuota.length >= availableQuota.length) && availableQuota.length > 0  ){
                $('#statushour').show();
                $('#statushour').html('Mohon maaf. seluruh quota sudah penuh, silahkan pilih tanggal lain ')
                //alert("Mohon maaf. seluruh quota sudah penuh, silahkan pilih tanggal lain ")
                 jQuery('.xdsoft_time_variant').hide()

            }

            //console.log(noQuota)
            // $this.find('.xdsoft_date').removeClass('xdsoft_disabled');
            // $this.find('.xdsoft_time').removeClass('xdsoft_disabled');
        },
        // dayOfWeek: [
        //     "Sen", "Sel", "Rab", "Kam",
        //     "Jum"
        // ]
        // onShow: function (current_time, $input) {
        //     console.log(current_time)
        //     console.log($input)
        // }
    });

    jQuery.validator.addMethod("phoneStartingWith0", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.match(/^0\d{0,}$/);
    }, "No Handphone harus dimulai dengan angka 0. contoh 08123345554");

     $("#registration_form").validate({
        rules: {
            nama: {
                required: true,
            },
            email:{
                email:true,
            },
            phone: {
                required: true,
                phoneStartingWith0:true
            },
            tanggal: {
                required: true,

            },
            jam: {
                required: true,

            },
            pelayanan: {
                required: true,

            }
        },
        messages: {
            nama: {
                required: "Nama Lengkap harus diisi",
                email: "Format email harus benar"
            },
            email: {
                email: "Format email harus benar",
            },
            phone:{
                required:"No Handphone harus diisi"
            },
            tanggal: {
                required: "Tanggal harus diisi"
            },
            jam: {
                required: "Jam harus diisi"
            },
            pelayanan: {
                required: "Pelayanan harus diisi"
            },


        }
    });

     function getAvailableQuota(date,pelayanan){

         jQuery('.xdsoft_time_box small.loadingtime').remove()
         jQuery('.xdsoft_time_box').append('<small class="loadingtime">Loading..</small>')

         jQuery('#time-picker').val('')
            jQuery('.xdsoft_time_variant').hide()
          $('#statushour').hide();
         // jQuery('.xdsoft_time_box small.loadingtime').show();
         // jQuery('.xdsoft_time_box small.loadingtime').text('Loading.. ')
         axios.post('{{ route('registration.getQuotaPerDay') }}', {
             day: date,
             pelayanan:pelayanan
         })
             .then(function (response) {
                 // console.log(response)
                 jQuery('.xdsoft_time_variant').show()
                 availableQuota = response.data;
             })
             .catch(function (error) {
                 jQuery('.xdsoft_time_box small.loadingtime').text('Error')
                 alert("Error, gagal mendapatkan info kuota jam tersedia, silahkan pilih tanggal lain atau reload halaman")
                 jQuery('.xdsoft_time_variant').hide()

             }).then(function () {
                 jQuery('.xdsoft_time_box small.loadingtime').remove()
                //$('.xdsoft_time_box small.loadingtime').hide()
            });
     }






</script>
@endpush



@endsection


@section('footer')
    <div class="container-fluid">
    <footer class="row justify-content-center no-gutters">
        <div class="col-12 col-lg-9">
            <div class="pt-4 mb-4 pt-md-5 border-top">
                <div class="row justify-content-center justify-content-md-start mb-3">
                    <div class="col-12 col-lg-5 text-center text-lg-left">
                        <img class="mb-2 " src="/assets/logo_blue.png" alt="" width="200">
                        <div class="link-site pl-3 mt-3">
                            <a class="d-block mb-2" href="https://kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>Kemnaker.go.id</u></a>
                            <a class="d-block" href="https://karirhub.kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>#KARIRhub</u></a>
                        </div>

                    </div>
                    <div class="col-12 col-lg-7 mt-5 mt-lg-0 text-secondary text-center text-lg-left">
                        <h5 class="text-pasker poppinsmedium">PASKER.ID</h5>
                        <p class="text-orange-pasker-light" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
                        <p>
                            Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                        </p>
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-8">
                                <i class="bi bi-telephone text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;0812 8108 9843<br/>
                                <i class="bi bi-envelope text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;layananpuspaker@kemnaker.go.id
                            </div>
                            <div class="col-12 col-lg-4 text-sm-left text-lg-right">
                                <div class="footer-social" style="font-size: 1.4rem">
                                    <a class="ml-3 d-inline-block text-pasker" href="https://twitter.com/pusatpasarkerja"><i class="bi bi-twitter"></i></a>
                                    <a class="ml-3 d-inline-block text-pasker" href="https://www.facebook.com/PusatpasarkerjaKemnaker"><i class="bi bi-facebook"></i></a>
                                    <a target="_blank" class="ml-3 d-inline-block text-pasker" href="https://www.instagram.com/pusatpasarkerja/"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </footer>
    </div>
@endsection



