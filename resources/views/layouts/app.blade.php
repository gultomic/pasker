<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', '') - PUSPASKER</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @livewireStyles
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-200 via-zinc-400 to-neutral-500">
        <div class="flex min-h-screen text-zinc-700"
            x-data="mainFrame()"
            x-on:keydown.escape="showModal=false"
            x-cloak>

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Section -->
            <div class="flex-1 overflow-y-auto">
                <!-- Page Heading -->
                <header class="flex items-center justify-between h-12">
                    <div class="flex">
                        <button type="button"
                            x-on:click="toggleSidebar"
                            class="hidden w-8 h-8 ml-1 rounded-full hover:bg-opacity-50 hover:bg-blue-300 lg:block">
                            <span class="text-xs fas" :class="fullSidebar?'fa-ellipsis-v':'fa-list-ul'"></span>
                        </button>

                        <div class="pl-3 my-auto">
                            <h2 class="text-xl font-extrabold leading-tight">
                                @yield('header', '')
                            </h2>
                        </div>
                    </div>

                    <div class="hidden mr-1 sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium transition duration-150 ease-in-out focus:outline-none">
                                    <div class="capitalize">{{ Auth::user()->profile->refs['fullname'] }}</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div> --}}
                </header>

                <!-- Page Content -->
                <main class="md:py-3">
                    <div class="mx-auto sm:px-3 lg:px-4">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <img src="/assets/sasageyo.png" class="fixed left-0 opacity-60 -bottom-10 md:h-3/6 -z-20"/>
        @livewireScripts
    </body>
</html>
