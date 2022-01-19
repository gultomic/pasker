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
        </div>
        <div class="col-lg-4 pb-5">
            <h1>Raih Pekerjaan Impianmu Melalui Pusat Pasar Kerja!</h1>
            <p>Isi form dibawah ini untuk daftar konsultasi pada <strong>Pusat Pasar Kerja</strong></p>

            <form action="{{ route('registration.online.submit') }}" method="POST" autocomplete="off">
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
                </div>

                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                        required="false">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pilih Pelayanan</label>
                    <select class="custom-select d-block w-100" name="pelayanan">
                        <option value="0"></option>
                        @foreach ( $pelayanan as $item )
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>

                </div>

                <button type="submit" class="btn btn-warning btn-lg mt-3 mb-3 w-100 ">Daftar
                    &nbsp;&nbsp;&nbsp;<i class="bi bi-arrow-right"></i>
                </button>
                <a class="d-block mt-2 text-white" href="#!" onclick="document.getElementById('about-pasar-kerja').scrollIntoView({behavior: 'smooth'});
                    "><u>Apa itu Pusat Pasar Kerja ?</u></a>
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
            <h3 class="text-pasker mb-3"> Selamat Datang di Pusat Pasar Kerja</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s</p>
            <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into electronic typesetting, remaining
                essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum
            <p>passages, and more recently with desktop publishing software like Aldus PageMaker including versions
                of Lorem Ipsum.</p>
            <p class="text-pasker" style="text-transform:uppercase;font-size:0.8em;margin-bottom:0 !important;">Dr.
                Dra. Hj. Ida Fauziyah, M.Si</p>
            <p class="text-secondary" style="font-size:0.8em;">Menteri Ketenagakerjaan Republik Indonesia</p>
        </div>

    </div>
</div>


@endsection