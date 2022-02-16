<div class="flex flex-col md:flex-row intro-x box">
    <div class="flex justify-center m-3 md:justify-start">
        <div class="relative flex-none w-32 h-32 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit">
            <img alt="Personal photo profile"
                class="rounded-full bg-theme-2"
                src="{{ $photo }}">
            <div class="absolute bottom-0 right-0 flex items-center justify-center p-2 mb-1 mr-1 rounded-full bg-theme-1">
                <i class="w-4 h-4 text-white" data-feather="camera"></i>
            </div>
        </div>
    </div>

    <div class="flex-1 px-5">
        <div class="flex items-center justify-between py-1">
            <div class="mt-3 font-medium text-left">Contact Details</div>
            <button class="inline-block py-0 hover:text-primary-9 btn btn-sm btn-primary-soft btn-rounded" wire:click='store'>
                simpan
            </button>
        </div>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 my-4 md:col-span-3">
                <div class="flex gap-6">
                    <div>
                        <label for="" class="text-gray-500 form-label">Username</label>
                        <input id="" type="text" class="form-control" wire:model="username">
                    </div>
                    <div>
                        <label for="" class="text-gray-500 form-label">Telp.</label>
                        <input id="" type="text" class="form-control" wire:model="phone">
                    </div>
                </div>

                <div class="mt-3">
                    <label for="" class="text-gray-500 form-label">Email</label>
                    <input id="" type="text" class="form-control" wire:model="email">
                </div>

                <div class="mt-3">
                    <label for="" class="text-gray-500 form-label">Nama Lengkap</label>
                    <input id="" type="text" class="form-control" wire:model="fullname">
                </div>
            </div>

            <div class="col-span-6 my-4 md:col-span-3">
            </div>
        </div>
    </div>
</div>
