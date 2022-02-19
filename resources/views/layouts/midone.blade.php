<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Pusat Pasar Kerja, Kementerian Ketenagakerjaan Republik Indonesia">
        <meta name="keywords" content="puspasker, pasker, kemnaker">
        <meta name="author" content="">

        <title>@yield('title', '') - PUSPASKER</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <!-- Styles -->
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> --}}
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

        <link rel="stylesheet" href="{{ '/css/dashboard-taufiq-staff.css' }}">

        @livewireStyles
        <!-- Scripts -->
        <!-- Alpine remove from now. since its conflict with modallivewire -->
        <!-- <script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>-->
    </head>

    <body class="main">
        <div class="flex" x-data="mainFrame()" x-cloak>
            @include('layouts.sidenav')
            <!-- BEGIN: Content -->
            <div class="content" style="min-height: auto;">
                @include('layouts.topbar')
                {{ $slot }}
            </div>
            <!-- END: Content -->
        </div>

        @livewire('livewire-ui-modal')
        <!-- Scripts -->
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/midone.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('script')
    </body>
</html>
