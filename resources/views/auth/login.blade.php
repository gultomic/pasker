@section('title', 'Login')

<x-guest-layout>
    <body class="login">
        <div class="container sm:px-10">
            <div class="block grid-cols-2 gap-4 xl:grid">
                <div class="flex-col hidden min-h-screen xl:flex">
                    <div class="flex items-center pt-5 -intro-x">
                        <span class="ml-3 text-lg text-white">
                            PASKER<span class="font-medium">.ID</span>
                        </span>
                    </div>
                    <div class="my-auto">
                        <img alt="JOBI PASKER.ID" class="w-1/2 -mt-16 -intro-x" src="/assets/logo_light.png">
                        <div class="mt-10 text-4xl font-medium leading-tight text-white -intro-x">PUSAT PASAR KERJA</div>
                        <div class="text-white -intro-x text-opacity-70 dark:text-gray-500">#SIAPKerja #KarirHub #TalentHub #GetAJobLiveBetter</div>
                    </div>
                </div>

                <div class="flex h-screen py-5 my-10 xl:h-auto xl:py-0 xl:my-0">
                    <div class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md xl:ml-20 dark:bg-dark-1 xl:bg-transparent sm:px-8 xl:p-0 xl:shadow-none sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="text-2xl font-bold text-center intro-x xl:text-3xl xl:text-left">Sign In</h2>
                        <div class="mt-2 text-center text-gray-500 intro-x xl:hidden">PASKER.ID #SIAPKerja #KarirHub #TalentHub #GetAJobLiveBetter</div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mt-3 mb-3 " :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mt-3 mb-3" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mt-8 intro-x">
                                    <input id="email"
                                        type="text"
                                        class="block px-4 py-3 border-gray-300 intro-x login__input form-control"
                                        name="email"
                                        :value="old('email')"
                                        required
                                        autofocus
                                        placeholder="Email">

                                    <input id="password"
                                        type="password"
                                        class="block px-4 py-3 mt-4 border-gray-300 intro-x login__input form-control"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Password">
                            </div>

                            <div class="mt-5 text-center intro-x xl:mt-8 xl:text-left">
                                <button class="w-full px-4 py-3 align-top btn btn-primary xl:w-32 xl:mr-3">Login</button>
                            </div>
                        </form>
                    </div>
                    <img src="/assets/pose01_preview_small.png" class="fixed bottom-0 hidden lg:block lg:h-3/6 -right-14 -z-20"/>
                </div>
            </div>
        </div>
    </body>
</x-guest-layout>
