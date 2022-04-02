@extends('layouts.bootstrap_public')

@section('content')
    <div class="container-fluid px-0">
        <div class="hero-home pb-5" style="padding-bottom: 7rem !important;">
            <div class="row justify-content-center justify-content-md-start">
                <div class="col-5 col-lg-2 pt-4 mx-5 text-center">
                    <img class="img-fluid" src="/assets/logo_light.png" alt="">

                </div>
            </div>
            <div class="row pt-2 text-center ">

            <div class="col-lg-12 pb-5 mt-md-n5 mt-0">
                <i class="bi bi-patch-check-fill" style="font-size: 7rem"></i>
                <h1>Pendaftaran Berhasil !</h1>
                <div><p>Terima kasih pendaftaranmu telah berhasil. Silahkan datang ke
                    <br>
                    Gedung Pusat Pasar Kerja untuk melakukan konsultasi pada :</p>

                    @if (session('booking_time'))
                    <h4>
                        {{ session('booking_time') }}
                    </h4>
                    <p>{{ session('booking_author') }}</p>
                    @endif
                    <br>
                    @if (session('booking_qrcode'))
                        {{ session('booking_qrcode') }}
                    @endif


                    <br>
                    <div class="row justify-content-center mt-3">

                            <div id="statushour" class="alert alert-warning col-lg-3 col-8" role="alert" style="font-size: 0.9rem;">
                        <small>*PENTING* Sebagai bukti tambahan silahkan screenshoot halaman ini beserta QR untuk ditunjukkan pada saat berkunjung</small>
                            </div>

                    </div>


                </div>


                <span class="d-block mb-3">
                    PUSAT PASAR KERJA
                    <br>
                    Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                </span>

                <a href="/" class="btn btn-small btn-outline-light"> Kembali</a>

            </div>
        </div>
        <img class="mascot-bottom d-none d-md-block" src="/assets/pose01_preview_small.png">
        </div>

    </div>

@endsection
