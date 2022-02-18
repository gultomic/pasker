<div class="flex flex-col md:flex-row intro-x box">
    <div class="flex justify-center m-3 md:justify-start">
        <div class="relative flex-none w-32 h-32 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit">
            <img alt="Personal photo profile"
                class="rounded-full bg-theme-2"
                src="{{ $display }}">

            <label class="absolute bottom-0 right-0 flex items-center justify-center p-2 mb-1 mr-1 rounded-full cursor-pointer bg-theme-1">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-white">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                <input type="file" class="hidden" wire:model="photo" accept="image/png, image/jpeg">
            </label>

            <button wire:click="store('photo')"
                class="
                    absolute bottom-0 left-0
                    flex items-center justify-center
                    p-2 mb-1 mr-1 bg-gray-600
                    rounded-full cursor-pointer
                    {{ $savePhoto }}
                ">
                <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"
                    fill="none" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-white animate-bounce">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline>
                </svg>
            </button>
        </div>
    </div>

    <div class="flex-1 px-5">
        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 my-4 md:col-span-7">
                <div class="flex items-center justify-between py-1 intro-x">
                    <div class="font-medium text-left">Contact Details {{$rowid}}</div>
                </div>

                <div class="flex gap-6">
                    <div class="intro-y">
                        <label class="text-gray-500 form-label">Username</label>
                        <input type="text" class="form-control" wire:model="username" disabled>
                        @error('username') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="intro-y">
                        <label class="text-gray-500 form-label">Email</label>
                        <input type="text" class="form-control" wire:model="email" disabled>
                        @error('email') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-3 intro-y">
                    <label class="text-gray-500 form-label">Telp.</label>
                    <div class="flex gap-x-2">
                        <input type="text" class="form-control" wire:model="phone">
                        <button class="btn btn-secondary" wire:click="store('phone')">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"
                                fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="w-6 h-6">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                        </button>
                    </div>
                    @error('phone') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                </div>

                <div class="mt-3 intro-y">
                    <label class="text-gray-500 form-label">Nama Lengkap</label>
                    <div class="flex gap-x-2">
                        <input type="text" class="form-control" wire:model="fullname">
                        <button class="btn btn-secondary" wire:click="store('fullname')">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"
                                fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="w-6 h-6">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                        </button>
                    </div>
                    @error('fullname') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-span-12 my-4 md:col-span-5">
                <div class="flex items-center justify-between py-1 intro-x">
                    <div class="font-medium text-left">Change Password</div>
                </div>

                <div class="intro-y">
                    <label class="text-gray-500 form-label">New Password</label>
                    <input type="password" class="form-control" wire:model="passwordNew">
                    @error('passwordNew') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                </div>

                <div class="mt-3 intro-y">
                    <label class="text-gray-500 form-label">Confirm New Password</label>
                    <input type="password" class="form-control" wire:model="passwordConfirm">
                    @error('passwordConfirm') <span class="italic font-light ext-xs text-theme-6">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between mt-3">
                <div class="my-auto text-xs">
                    @if (session()->has('message'))
                        <span class="intro-y">{{ session('message') }}</span>
                    @endif
                </div>

                <button class="btn btn-sm btn-warning-soft intro-y" wire:click="store('password')">
                    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"
                        fill="none" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 mr-2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    simpan
                </button>
                </div>
            </div>
        </div>
    </div>
</div>
