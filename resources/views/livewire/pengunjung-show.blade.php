<div class="grid grid-cols-12 gap-6">
    <div class="flex flex-col-reverse col-span-12 lg:col-span-4 2xl:col-span-3 lg:block">
        <div class="flex items-center mb-5 -intro-x">
            <h2 class="mr-auto text-lg font-medium">Identitas Pribadi</h2>
        </div>

        <div class="box lg:mt-0 intro-y">
            <form action="" class="p-5">
                <div>
                    <label for="" class="form-label">Nama</label>
                    <input id=""
                        wire:model="row.name"
                        type="text"
                        class="form-control"
                        required
                        placeholder="Input text">
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">No. Telp.</label>
                    <input id=""
                        wire:model="row.phone"
                        type="text"
                        class="form-control"
                        required
                        placeholder="Input phone">
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Email</label>
                    <input id=""
                        wire:model="row.email"
                        type="email"
                        class="form-control"
                        required
                        autocomplete="false"
                        placeholder="Input email">
                </div>
                <div class="mt-3">
                    <button type="submit"
                    class="w-24 mb-2 mr-1 btn btn-sm btn-rounded-primary"
                    wire:click.prevent="store">simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex flex-col-reverse col-span-12 lg:col-span-8 2xl:col-span-9 lg:block">
        <div class="flex items-center mb-5 -intro-x">
            <h2 class="mr-auto text-lg font-medium">Daftar Riwayat Pelayanan</h2>
        </div>

        <div class="lg:mt-0 intro-y">
            @foreach ($row->kunjungan as $item)
            <div class="px-4 py-2 mb-3 border-l-4 border-theme-9 box intro-y">
                <div class="font-medium text-theme-9">
                    Tanggal: {{ $item->tanggal }}
                </div>
                <div class="text-xl font-medium">
                    {{ $item->pelayanan->title }}
                </div>
                <div class="text-gray-500">
                    Dilayani oleh: {{ $item->pelaksana_id != null ? $item->pelaksana->refs['fullname'] : '' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- BEGIN: Notification Content -->
    <div id="success-notification-toast" class="hidden toastify-content">
        <div class="flex flex-col sm:flex-row">
            <i class="text-theme-9" data-feather="check-circle"></i>
            <div class="ml-2 mr-4 font-medium">Data tersimpan!</div>
        </div>
    </div>
    <!-- END: Notification Content -->

    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('updatedRow', () => {
                Toastify({
                    node: cash("#success-notification-toast")
                        .clone()
                        .removeClass("hidden")[0],
                    duration: 2000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                }).showToast()
            })
        })
    </script>
    @endpush
</div>
