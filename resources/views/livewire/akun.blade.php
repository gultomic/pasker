<x-card-content class="bg-white intro-x">
    <x-slot name="contentSection">
        <div x-data="{formShow:false}" x-cloak>
            <form action="" x-show="formShow" class="intro-x" >
                <div class="flex flex-col p-2 mt-3 border rounded-lg bg-theme-22">
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label for="fullname" class="text-xs form-label">Nama Lengkap</label>
                            <input name="fullname"
                                type="text"
                                class="form-control"
                                wire:model="fullname">
                        </div>
                        <div class="w-3/12">
                            <label for="email" class="text-xs form-label">Email</label>
                            <input name="email"
                                type="email"
                                class="lowecase form-control"
                                wire:model="email">
                        </div>
                        <div class="w-2/12">
                            <label for="username" class="text-xs form-label">Username</label>
                            <input name="username"
                                type="text"
                                class="form-control"
                                wire:model="username">
                        </div>
                        <div class="w-2/12">
                            <label for="phone" class="text-xs form-label">Phone</label>
                            <input name="phone"
                                type="text"
                                class="form-control"
                                wire:model="phone">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3">
                        <div class="flex gap-x-6">
                        <div class="-mt-1 form-check">
                            <input name="access"
                                type="checkbox"
                                class="form-check-input"
                                wire:model="access">
                            <label class="form-check-label" for="">Access</label>
                        </div>
                        <div>
                            <label class="form-label" for="">Role:</label>
                            <select class="form-select-sm sm:mr-2" wire:model="role" aria-label="select role">
                                <option value="staf">Staf</option>
                                <option value="master">Master</option>
                            </select>
                        </div>
                        </div>

                        <div class="flex">
                            <button type="submit"
                                class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-primary"
                                wire:click.prevent="store">simpan</button>
                            <button type="button"
                                class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-warning"
                                wire:click.prevent="resetForm" x-on:click="formShow=false">reset</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="flex items-center justify-between p-2 mr-auto">
                <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                    <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">Value</label>
                    <input type="search"
                        wire:model="search"
                        class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0"
                        placeholder="Search...">
                </div>
                <div>
                    <button class="w-24 mb-2 mr-1 btn btn-sm btn-primary" x-on:click="formShow=true">
                        <svg viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" class="w-6 h-6 mr-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        User
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead class="text-xs uppercase">
                    <tr>
                        <th class="p-2 bg-gray-300 rounded-l-lg">
                            <div class="font-semibold text-left">#</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-left">Identification</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Username</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Phone</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold text-center">Role</div>
                        </th>
                        <th class="p-2 bg-gray-300">
                            <div class="font-semibold">Access</div>
                        </th>
                        <th class="p-2 bg-gray-300 rounded-r-lg">
                            <div class="font-semibold">Action</div>
                        </th>
                    </tr>
                </thead>

                <tbody class="font-medium divide-y">
                    @foreach ($collection as $item)
                        <tr class="hover:bg-gray-200 intro-x">
                            <td class="">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit">
                                        <img alt="image {{ $item->profile->refs['fullname'] }}"
                                            class="rounded-full"
                                            src="{{ asset($item->profile->refs['photo']) }}">
                                    </div>
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="font-medium text-left whitespace-nowrap">{{ $item->profile->refs['fullname'] }}</div>
                                <div class="-mt-1 text-xs text-gray-500 whitespace-nowrap">{{ $item->email }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->username }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->phone }}</div>
                            </td>
                            <td class="p-2">
                                <div class="text-center">{{ $item->role->level }}</div>
                            </td>
                            <td class="p-2">
                                <div class="form-check">
                                    <input id="checkbox-switch-7"
                                        class="form-check-switch"
                                        type="checkbox"
                                        {{ ($item->access)?'checked':'' }}
                                        wire:click.prevent="setAccess({{ $item->id }})">
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="flex gap-x-2">
                                    <a href="{{ route('admin.akun.show', ['id' => $item->id]) }}"
                                        class="flex items-center font-light text-theme-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="block w-4 mx-auto mr-1">
                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                        Rincian
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center gap-6 mt-4">
            <div>
                <select class="form-select-sm sm:mr-2" wire:model="paginate" aria-label="select paginate">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="flex-1">
            {{ $collection->links() }}
            </div>
        </div>
    </x-slot>
</x-card-content>
