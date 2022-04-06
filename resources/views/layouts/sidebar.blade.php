<nav class="sticky top-0 hidden overflow-y-auto md:block"
    :class="fullSidebar?'lg:w-60 md:w-12':'w-12'"
    x-cloak>

    <div class="flex flex-col items-center flex-shrink-0">
        <a href="{{ route('registration.online.home') }}"
            class="flex justify-center m-2 bg-blue-300 rounded-full"
            :class="fullSidebar?'lg:w-40 lg:h-40':''">
            <img src="{{ Auth::user()->profile->refs['photo'] }}" class="object-cover rounded-full"/>
        </a>

        <div x-show="fullSidebar"
            class="hidden mx-2 text-2xl font-bold text-center lg:block">
            {{-- {{ Auth::user()->profile->refs['fullname'] }} --}}
            PaskerID
        </div>

    </div>

    <div class="mt-6">
        @foreach ($appRoutes as $item)
            <x-nav-sidebar :href="route($item['route'])"
                :active="request()->routeIs($item['path'])"
                :icon="$item['icon']">
                {{__($item['title'])}}
            </x-nav-sidebar>
        @endforeach
    </div>
</nav>
