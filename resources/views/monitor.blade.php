@section('title', $title)

<x-public-layout>
    <div class="overflow-hidden bg-gray-800 shadow bg-opacity-80 sm:rounded-xl">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="grid grid-cols-2 gap-4 p-4">
                @foreach ($loket as $key => $item)
                    <div class="text-center bg-opacity-50 rounded-md h-28 bg-sky-100">
                        <div class="text-2xl font-bold uppercase text-amber-200 rounded-t-md bg-sky-600">
                            {{ $item }}
                        </div>

                        <div id="loket_{{ $key }}" class="h-12 pt-3 font-mono font-black leading-9 text-white text-7xl"></div>
                        <div id="name_{{ $key }}" class="p-1 text-lg font-semibold truncate"></div>
                    </div>
                @endforeach
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <div class="ml-4 text-lg font-semibold leading-7"><a href="https://laracasts.com" class="text-gray-900 underline dark:text-white">Media Informasi</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore iste adipisci ipsum illo asperiores nam ducimus enim aliquid, quae iure consequuntur dicta! Excepturi fugit provident enim. Eum necessitatibus nobis obcaecati?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos voluptatum eveniet quibusdam officiis, culpa facilis a ab autem? Aliquam temporibus officia quisquam eveniet nobis ducimus veritatis nesciunt fuga excepturi beatae?</p>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed laborum placeat ducimus necessitatibus sint eveniet, eum optio. Veniam, illum repellat libero dignissimos, accusamus dolorem, minima provident necessitatibus atque architecto quod.</p>
                        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sed maiores, voluptates consequuntur eligendi odit quia vel nam eaque ipsa amet, quos consequatur ducimus laudantium enim recusandae distinctio quis rem!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            Echo.channel('QueuesEvent')
                .listen('QueuesService', (e) => {
                    document.querySelector(`#loket_${e.collection.index}`).innerHTML = e.collection.token
                    document.querySelector(`#name_${e.collection.index}`).innerHTML = e.collection.name
                })
        </script>
    @endpush
</x-public-layout>
