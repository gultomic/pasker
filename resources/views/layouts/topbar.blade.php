<!-- BEGIN: Top Bar -->
<div class="mb-4 top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="hidden mr-auto -intro-x breadcrumb sm:flex">
        <h2 class="text-xl font-bold">
            @yield('header', '')
        </h2>
        {{-- <a href="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Dashboard</a> --}}
    </div>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <div class="w-8 h-8 intro-x dropdown">
        <div class="w-8 h-8 overflow-hidden bg-gray-400 rounded-full shadow-lg dropdown-toggle image-fit zoom-in" role="button" aria-expanded="false">
            <i class="text-2xl fas fa-user-cog"></i>
        </div>
        <div class="w-56 dropdown-menu">
            <div class="text-white dropdown-menu__content box bg-theme-26 dark:bg-dark-6">
                <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                    <div class="font-medium">{{ Auth::user()->profile->refs['fullname'] }}</div>
                    {{-- <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">STAF</div> --}}
                </div>
                <div class="p-2">
                    <a href="{{ route('profile')}}" class="flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-theme-1 dark:hover:bg-dark-3">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile
                    </a>
                    {{-- <a href="" class="flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-theme-1 dark:hover:bg-dark-3">
                        <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account
                    </a> --}}
                    {{-- <a href="" class="flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-theme-1 dark:hover:bg-dark-3">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password
                    </a> --}}
                    {{-- <a href="" class="flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-theme-1 dark:hover:bg-dark-3">
                        <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help
                    </a> --}}
                </div>
                <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            class="flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-theme-1 dark:hover:bg-dark-3"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
