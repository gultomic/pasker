@extends('midone.layout.base')

@section('body')
    <body class="main">
        @yield('content')
{{--        @include('midone.layout.components.dark-mode-switcher')--}}

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('midone/dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection
