<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', '') - PUSPASKER</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #fefefe;
            }
            .top-banner {
                /* background-color: #074934; */
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="h-screen bg-gradient-to-br from-emerald-900 via-emerald-700 to-emerald-300">
            <img src="/assets/pose01_preview.png" class="fixed bottom-0 md:h-4/6 -right-14"/>
            <div class="flex flex-col-reverse justify-between md:flex-row top-banner">
                <div class="p-1 mx-auto md:mx-px">
                    <a href="/">
                        <img src="/assets/logo_light.png" class="object-cover h-12 md:h-16"/>
                    </a>
                </div>

                <div class="my-auto text-3xl font-black text-center text-slate-50">
                    PUSAT PASAR KERJA
                </div>

                {{-- <div class="text-white">
                @if (Route::has('login'))
                    <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                </div> --}}

                <div class="hidden px-2 md:block">
                    <div id="mDate" class="text-lg uppercase text-slate-100"></div>
                    <div id="mTime" class="font-mono text-4xl font-black leading-7 text-right text-yellow-300"></div>
                </div>
            </div>

            <div class="relative flex justify-center items-top">
                <div class="mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
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

            // Echo.channel('QueuesEvent')
            //     .listen('QueuesService', (e) => {
            //         document.querySelector(`#loket_${e.collection.index}`).innerHTML = e.collection.token
            //     })
        </script>

        @stack('scripts')
    </body>
</html>
