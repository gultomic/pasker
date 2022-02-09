<div class="grid grid-cols-12 gap-6">
    {{-- @dd($collection) --}}
    <div class="col-span-12 md:col-span-6">
        <div class="relative p-5 overflow-hidden lg:p-8 box bg-theme-16 intro-y">
            <div class="w-full -mt-3 text-xl font-light text-theme-12">Ringkasan Kegiatan Pelayanan.</div>
            <div class="flex flex-col w-full gap-2 mt-2 text-white">
                @foreach ($collection->groupBy('title') as $key => $item)
                    <div class="flex items-center">
                        <div class="pl-4 border-l-2 border-theme-12">
                            <div class="font-medium">{{ $key }}</div>
                            <div class="text-gray-400">
                                <span><i data-feather="user" class="w-4 h-4 text-theme-12"></i> {{ $item->count() }}</span>
                                <span class="ml-2"><i data-feather="star" class="w-4 h-4 text-theme-12"></i> {{ $item->count() }}</span>
                                <span class="ml-2"><i data-feather="award" class="w-4 h-4 text-theme-12"></i> {{ $item->count() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- <div class="col-span-12 md:col-span-6">
        <div class="relative p-5 overflow-hidden lg:p-8 bg-theme-12 box intro-y">
            <div class="w-full -mt-3 text-xl ads-box__title sm:w-52 text-theme-1 dark:text-white">Invite friends to get <span class="font-medium">FREE</span> bonuses!</div>
            <div class="w-full mt-2 leading-relaxed text-gray-600 sm:w-60">Get a IDR 100,000 voucher by inviting your friends to fund #BecomeMember</div>
            <div class="relative w-48 mt-6 cursor-pointer tooltip" title="Copy referral link">
                <input class="form-control" value="https://dashboard.in">
                <i data-feather="copy" class="absolute top-0 bottom-0 right-0 w-4 h-4 my-auto mr-4"></i>
            </div>
        </div>
    </div> --}}

    <div class="col-span-12">
        {{-- @foreach ($collection->groupBy('title') as $item)
            <div class="pb-4">{{ $item }}</div>
        @endforeach --}}
    </div>
</div>
