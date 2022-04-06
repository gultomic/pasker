{{-- @include('midone/layout/components/mobile-menu') --}}
<!-- BEGIN: Simple Menu -->
<nav class="side-nav">
    <a href="/" class="flex items-center lg:p-8 -intro-y">
        <img alt="{{ Auth::user()->profile->refs['fullname'] }} image"
            class="object-cover rounded-full lg:h-36 lg:w-36"
            src="{{ Auth::user()->profile->refs['photo'] }}">
    </a>

    <div class="my-3 side-nav__devider"></div>

    <ul>
        @foreach ($appRoutes as $item)
            <li>
                <a href="{{ route($item['route']) }}"
                    class="side-menu {{ (request()->routeIs($item['path']) ?? true) ? 'side-menu--active' : ''}}">
                    <div class="side-menu__icon">
                        <i class='text-2xl {{ $item['icon'] }}'></i>
                    </div>
                    <div class="side-menu__title">{{__($item['title'])}}</div>
                </a>
            </li>
        @endforeach
        <li class="my-6 side-nav__devider"></li>
    </ul>
</nav>
<!-- END: Simple Menu -->
