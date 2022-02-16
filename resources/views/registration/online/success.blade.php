@extends('layouts.bootstrap_public')

@section('content')
    <div class="container-fluid hero-home pb-5">
        <div class="row">
            <div class="col-2 pt-5 mx-5">
                <img class="img-fluid" src="/assets/logo_light.png" alt="">
            </div>
        </div>
        <div class="row pt-2 text-center ">

            <div class="col-lg-12 pb-5">
                <i class="bi bi-patch-check-fill" style="font-size: 8rem"></i>
                <h1>Pendaftaran Berhasil !</h1>
                <p>Terima kasih pendaftaranmu telah berhasil. Silahkan datang ke
                    <br>
                    Gedung Pusat Pasar Kerja untuk melakukan konsultasi pada :
                    <br>
                    @if (session('booking_time'))
                    <strong>
                        {{ session('booking_time') }}
                    </strong>
                    @endif
                </p>


                <small class="d-block mb-3">
                    PUSAT PASAR KERJA
                    <br>
                    Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                </small>

                <a href="/" class="btn btn-small btn-outline-light"> Kembali</a>

            </div>
        </div>
        <img class="mascot-bottom" src="/assets/pose01_preview_small.png">

    </div>
@endsection
