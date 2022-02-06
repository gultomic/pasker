@extends('layouts.bootstrap_public')
@section('content')

<div class="container-fluid hero-home pb-5">
    <div class="row">
        <div class="col-2 pt-4 mx-5">
            <img class="img-fluid" src="/assets/logo_light.png" alt="">
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-lg-1">
            &nbsp;
        </div>
        <div class="col-lg-5 pb-4 text-right">
            <!-- <img class="position-absolute" style="bottom:0;right:0;" src="/assets/young-man.png" alt=""> -->
            <img class="img-fluid text-right" src="/assets/pose01_preview_small.png" alt="">
            <small class="text-left d-block" style="color: #eef9f6">JOBI - Maskot Pasker ID</small>
        </div>
        <div class="col-lg-4 pb-5 mt-n4 text-center">
            <h1 class="head_grobold">Malas Antri ?</h1>
            <div class="subhead_page rounded">
                <span>Daftar online aja</span>
            </div>

            @if (session('exist_request_date'))
            <div class="alert alert-warning" role="alert" style="font-size: 0.9rem">
                <strong>Pendaftaran Tidak Berhasil</strong>
                <p>Anda telah memiliki jadwal pada hari yang sama <br/>{{ session('exist_request_date') }}</p>
            </div>
            @endif
            <form action="{{ route('registration.online.submit') }}" id="registration_form" class="text-left" method="POST" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" id="nama-lengkap" name="nama" autocomplete="off"
                        required="true">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No. Handphone *</label>
                    <input type="number" class="form-control" id="no-handphone" name="phone" autocomplete="off"
                        required="true">
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
                        >
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

                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pilih Pelayanan</label>
                    <select class="custom-select d-block w-100" name="pelayanan">
                        <option value=""></option>
                        @foreach ( $pelayanan as $item )
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>

                </div>

                <button type="submit" class="btn btn-warning btn-lg mt-3 mb-3 w-100 ">Daftar
                    &nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-right"></i>
                </button>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <a class="d-block text-white" href="#!" onclick="document.getElementById('about-pasar-kerja').scrollIntoView({behavior: 'smooth'});
                            ">
                            <u>Apa itu Pasker ID ?</u>
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
    </div>

</div>
<div class="container mx-5" id="about-pasar-kerja">
    <div class="row text-center">
        <div class="col-lg-6">
            <img class="img-fluid" src="/assets/ibuida.png" alt="">
        </div>
        <div class="col-lg-6 text-left">
            <h3 class="text-pasker mb-3"> Selamat Datang di <strong>Pasker ID</strong></h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s</p>
            <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into electronic typesetting, remaining
                essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum
            <p>passages, and more recently with desktop publishing software like Aldus PageMaker including versions
                of Lorem Ipsum.</p>
            <p class="text-orange-pasker-light" style="text-transform:uppercase;font-size:0.8em;margin-bottom:0 !important;">Dr.
                Dra. Hj. Ida Fauziyah, M.Si</p>
            <p class="text-secondary" style="font-size:0.8em;">Menteri Ketenagakerjaan Republik Indonesia</p>
        </div>

    </div>
</div>




<!-- Modal -->
<div class="modal fade modal-kiosk" id="disclaimer-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-5">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " style="font-size: 0.9rem">
                <div class="" id="">
                    <h2 class="text-center text-pasker mb-4">Disclaimer Pasker ID</h2>
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


@endsection




@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>

    //TODO : disable on holiday
    // TODO : show only available quota
    // TODO : send event to staffrom
    // TODO: start date end date



    jQuery.datetimepicker.setLocale('id');
    // $('#datetimepicker').on('click',function (){
    //     $('#datetimepicker').datetimepicker('show');
    // })

    var holidays =[];
    var jamloket = JSON.parse(@json($jam_loket));


        // function setHolidays(date) {
        //     for (i = 0; i < holidays.length; i++) {
        //         if (date.getFullYear() == holidays[i][0]
        //             && date.getMonth() == holidays[i][1] - 1
        //             && date.getDate() == holidays[i][2]) {
        //             return [false, 'holiday', holidays[i][3]];
        //         }
        //     }
        //
        //     var noWeekend = jQuery('#date-picker').noWeekends(date);
        //     return !noWeekend[0] ? noWeekend : [true];
        // }

    var minTime = '';
    var maxTime = '';

    jQuery('#date-picker').datetimepicker({
        timepicker: false,
        onSelectDate: function (ct,$input) {
            //alert(moment(ct).format('d'))
            //console.log(jamloket[moment(ct).format('d')])
            minTime = jamloket[moment(ct).format('d')].jam_buka
            var maxTimeBef = jamloket[moment(ct).format('d')].jam_tutup
            maxTime = maxTimeBef.replace(maxTimeBef.substr(maxTimeBef.length-1),'1')
            console.log(maxTime)
            console.log(maxTimeBef.length);
            console.log(minTime)
            jQuery('#time-picker').val('')
            // setTimeout(function () {
            //     $(".xdsoft_time_variant").css({"margin-top": 0});
            // }, 10)
            //jQuery('#time-picker').setOptions({allowTimes: ['09:00']})
        },
        onGenerate: function(ct,$input) {
            $(this).find('.xdsoft_date.xdsoft_weekend').remove();
            $('.xdsoft_calendar table thead tr th').filter(':nth-child(1), :nth-child(7)').remove();
            $input.prop('readonly', true);
            var $this = $(this);
            $this.find('.xdsoft_date').removeClass('xdsoft_disabled');
            $this.find('.xdsoft_time').removeClass('xdsoft_disabled');
        },
        format: 'd M Y',
        scrollInput: false,
        minDate: '-1970/01/01',//yesterday is minimum date(for today use 0 or -1970/01/01)
        maxDate: '+1970/01/03'//tomorrow is maximum date calendar
        // dayOfWeek: [
        //     "Sen", "Sel", "Rab", "Kam",
        //     "Jum"
        // ]
        // onShow: function (current_time, $input) {
        //     console.log(current_time)
        //     console.log($input)
        // }
    });

    jQuery('#time-picker').datetimepicker({
        datepicker: false,
        // allowTimes:[
        //  '09:00', '10:00', '11:00','12:00','13:00','14:00','15:00','16:00'
        // ],
        onShow: function (ct) {
            this.setOptions({
                minTime: minTime,
                maxTime: maxTime,
            })
        },
        minTime: minTime,
        maxTime:maxTime,
        format: 'H:i',
        scrollInput: false,
        onGenerate: function(ct,$input) {

            $input.prop('readonly', true);
            var $this = $(this);
            $this.find('.xdsoft_date').removeClass('xdsoft_disabled');
            $this.find('.xdsoft_time').removeClass('xdsoft_disabled');
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






</script>

@endsection
