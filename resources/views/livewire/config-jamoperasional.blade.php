<div class="col-span-12 intro-y box lg:col-span-9">
    <div class="flex items-center p-3 border-b border-gray-200 -intro-x sm:flex-row dark:border-dark-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-theme-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h2 class="pl-2 mr-auto text-base font-medium">Master Jam Operasional</h2>
    </div>

    <form action="" wire:submit.prevent='store'>
    <div class="grid grid-cols-12 gap-4 p-4">
            @foreach ($row as $key => $item)
                <div wire:key="field-{{ $key }}"
                    class="col-span-4 p-1 border rounded-md lg:col-span-3 intro-y">

                    <div class="mb-4 font-medium text-center">{{ $item['hari'] }}</div>

                    <div class="flex flex-col gap-2 px-2">
                        <div class="flex justify-between form-inline">
                            <label class="italic text-gray-500 form-label">Kuota / jam:</label>
                            <input wire:model="row.{{ $key }}.kuota_per_jam" type="text" class="pl-1 border-b w-14">
                        </div>

                        <div class="flex justify-between form-inline">
                            <label class="italic text-gray-500 form-label">Jam Buka:</label>
                            <input id="" type="time" class="pl-1 border-b w-18" wire:model="row.{{ $key }}.jam_buka">
                        </div>

                        <div class="flex justify-between form-inline">
                            <label class="italic text-gray-500 form-label">Jam Tutup:</label>
                            <input id="" type="time" class="pl-1 border-b w-18" wire:model="row.{{ $key }}.jam_tutup">
                        </div>

                        <div class="flex justify-between form-inline">
                            <label class="italic text-gray-500 form-label">Status Libur:</label>
                            <input id="" type="checkbox" class="pl-1 border-b w-14" wire:model="row.{{ $key }}.libur">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-span-4 p-1 text-center lg:col-span-3 intro-y">
                <button class="my-auto btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
</div>
