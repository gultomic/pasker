<div class="col-span-12 md:col-span-6" x-data="alpTable({{$table}})" x-cloak>
    <div class="relative flex w-full gap-4 p-3 overflow-hidden box">
        <div class="flex flex-col lg:flex-row">
            <div class="form-inline">
                <input id=""
                    type="date"
                    class="form-control"
                    wire:model="startDate"
                    placeholder="Input phone">
            </div>
            <div class="form-inline">
                <label for="" class="hidden mx-2 lg:block">to:</label>
                <input id=""
                    type="date"
                    class="mt-2 form-control lg:mt-0"
                    wire:model="endDate"
                    placeholder="Input phone">
            </div>
        </div>

        <button class="w-full btn btn-primary btm-sm" wire:click='resetDate'>Bersihkan</button>
    </div>

    <div class="relative p-3 mt-3 overflow-hidden box">
        <div class="flex items-center justify-between mb-2">
            <div>
                <span>Total: </span>
                <span x-text="total"></span>
                <span> records</span>
            </div>
            <select class="w-20 mt-3 form-select box sm:mt-0"
                x-on:change="alpPaginate($event.target.value)" x-model="paginate">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
        </div>

        @if ($table->count() > 0)
        <table class="table">
            <thead class="text-xs uppercase">
                <tr>
                    <th class="p-2 bg-gray-300 rounded-l-lg">
                        <div class="font-semibold text-left">Tanggal</div>
                    </th>
                    <th class="p-2 bg-gray-300">
                        <div class="font-semibold text-left">Total Pelayanan</div>
                    </th>
                    <th class="p-2 bg-gray-300 rounded-r-lg">
                        <div class="font-semibold">Skor</div>
                    </th>
                </tr>
            </thead>

            <tbody class="font-medium divide-y">
                <template x-for="(item,x) in displayTable" :key="x" x-cloak>
                    <tr class="hover:bg-gray-200 intro-x">
                        <td class="p-2">
                            <div class="text-left" x-text="item.tanggal"></div>
                        </td>
                        <td class="p-2">
                            <div class="text-left" x-text="item.total"></div>
                        </td>
                        <td class="p-2">
                            <div class="text-left" x-text="item.skor"></div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <div class="flex flex-wrap items-center mt-3 intro-y sm:flex-row sm:flex-nowrap">
            <ul class="pagination">
                <li>
                    <button class="p-1"
                        x-bind:class="pageNumber==1?'text-gray-400':'hover:bg-gray-300'"
                        x-bind:disabled="pageNumber==1?true:false"
                        x-on:click="prevPage">
                        <i class="w-5 h-5" data-feather="chevron-left"></i>
                    </button>
                </li>

                <template x-for="x in pageCount" :key="x">
                    <li>
                        <button class="px-2 py-1 mx-1"
                            x-bind:class="pageNumber==x?'border-b border-gray-500':'hover:bg-gray-300'"
                            x-text="x"
                            x-on:click="viewPage(x)"></button>
                    </li>
                </template>

                <li>
                    <button class="p-1"
                        x-bind:class="pageNumber==pageCount?'text-gray-400':'hover:bg-gray-300'"
                        x-bind:disabled="pageNumber==pageCount?true:false"
                        x-on:click="nextPage">
                        <i class="w-5 h-5" data-feather="chevron-right"></i>
                    </button>
                </li>
            </ul>
        </div>
        @else
            <div>Tidak dapat menemukan data.</div>
        @endif
    </div>
</div>
