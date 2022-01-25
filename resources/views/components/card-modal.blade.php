@props([
    'type'=> 'primary',
    'header'
])

<!-- Modal -->
<div
    wire:ignore.self
    class="fixed inset-0 z-20 w-full h-full overflow-y-auto duration-300 bg-black bg-opacity-50"
    x-show="showModal"
    x-transition:enter="transition duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak>
    <div class="relative mx-2 my-10 opacity-100 sm:w-3/4 md:w-1/2 lg:w-1/3 sm:mx-auto">
        <div
            class="relative z-20 text-gray-900 bg-white shadow-lg rounded-2xl"
            @click.away="showModal = false"
            x-show="showModal"
            x-transition:enter="transition transform duration-300"
            x-transition:enter-start="scale-0"
            x-transition:enter-end="scale-100"
            x-transition:leave="transition transform duration-300"
            x-transition:leave-start="scale-100"
            x-transition:leave-end="scale-0"
        >
            <header class="flex flex-col items-center justify-center p-3 modal {{ $type }}-text">
                <h2 class="text-2xl font-semibold">{{ $header }}</h2>
            </header>

            <main class="p-3 text-center">
                {{ $slot }}
            </main>

            <footer class="flex justify-center bg-transparent">
                <button
                    type="submit"
                    class="w-full py-3 font-semibold text-white transition-all duration-300 modal {{ $type }}-bg shadow-lg rounded-b-2xl focus:outline-none hover:shadow-none"
                    x-on:click="showModal=false"
                    wire:click.prevent="store()"
                >
                    Simpan
                </button>
            </footer>
        </div>
    </div>
</div>
