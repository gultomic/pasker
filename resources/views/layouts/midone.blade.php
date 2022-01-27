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
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('midone/dist/css/app.css') }}">

        @livewireStyles
    </head>

    <body class="main">
        <div class="flex">
            @include('layouts.sidenav')
            <!-- BEGIN: Content -->
            <div class="content">
                @include('layouts.topbar')
                {{ $slot }}
            </div>
            <!-- END: Content -->
        </div>

        <!-- Scripts -->
        <script src="{{ asset('midone/dist/js/app.js') }}"></script>
        @stack('script')
        @livewireScripts
    </body>
</html>
