<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="min-h-screen antialiased bg-gradient-to-br from-slate-200 via-zinc-400 to-slate-300">
        <img src="/assets/pose01_preview.png" class="fixed bottom-0 md:h-4/6 -right-14 -z-20"/>
        <div class="mt-10 font-sans text-gray-900">
            {{ $slot }}
        </div>
    </body>
</html>
