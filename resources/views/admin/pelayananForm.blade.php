<form class="mb-3 text-left">
    <div class="py-1">
        <x-label for="title" :value="__('Title/Judul')" class="text-gray-400"/>
        <x-input type="text"
            class="block w-full"
            name="title"
            wire:model="title"
            required
            autocomplete="off"/>

        @error('title')
            <x-labelError message="{{ $message }}" />
        @enderror
    </div>

    <div class="flex gap-3">
        <div class="w-2/5 py-1">
            <x-label for="kode" :value="__('Kode/Huruf')" class="text-gray-400"/>
            <x-input type="text"
                class="block w-full uppercase"
                name="kode"
                wire:model="kode"
                required
                autocomplete="off"/>

            @error('kode')
                <x-labelError message="{{ $message }}" />
            @enderror
        </div>

        <div class="w-2/5 py-1">
            <x-label for="limit" :value="__('Limit/Batas')" class="text-gray-400"/>
            <x-input type="text"
                class="block w-full"
                name="limit"
                wire:model="antrian"
                required
                autocomplete="off"/>

            @error('limit')
                <x-labelError message="{{ $message }}" />
            @enderror
        </div>

        <div class="w-1/5 py-1">
            <x-label for="status" :value="__('Aktif')" class="text-gray-400"/>

            <label class="inline-flex items-center mt-2">
                <input type="checkbox"
                    class="w-6 h-6 text-blue-500 border-gray-300 rounded-md form-checkbox"
                    x-model="status"
                    wire:model='aktif'
                    >
            </label>
        </div>
    </div>

    <div class="flex-1 py-1">
        <x-label for="deskripsi" :value="__('Keterangan')" class="text-gray-400"/>
        <x-textarea
            class="block w-full"
            wire:model='deskripsi'
            name="deskripsi"/>

        @error('deskripsi')
            <x-labelError message="{{ $message }}" />
        @enderror
    </div>
</form>
