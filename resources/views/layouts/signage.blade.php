<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Signage</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css" />


    <link href="{{ asset('css/public-vendors/eocjs-newsticker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signage.css') }}" rel="stylesheet">

</head>

<body id="signage">
    {{ $slot }}

{{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"--}}
{{--        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">--}}
{{--    </script>--}}

    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('/js/public-vendors/eocjs-newsticker.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>



    <script>
        moment.locale('id');
        document.addEventListener('DOMContentLoaded', () => {
            let date = document.getElementById('mDate')
            let time = document.getElementById('mTime')

            moment().locale()
            date.innerHTML = moment().format('dddd, Do MMMM YYYY')
            setInterval(() => {
                time.innerHTML = moment().format('H:mm:ss')
            }, 1000);
        })




    </script>
    @stack('scripts')

</body>

</html>
