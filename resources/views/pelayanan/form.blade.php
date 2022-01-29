<!-- BEGIN: Modal Content -->
{{-- <div id="midone-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="mr-auto text-base font-medium">header</h2>
            </div> --}}
            <x-midone-modal-form header="modwar">
            <div class="flex flex-col modal-body gap-y-3">
                <div class="w-full">
                    <label for="" class="text-xs form-label">Nama Pelayanan</label>
                    <input name=""
                        type="text"
                        class="form-control"
                        wire:model="title">
                </div>

                <div class="flex gap-x-4">
                    <div class="w-2/5">
                        <label for="" class="text-xs form-label">Kode/Huruf</label>
                        <input name=""
                            type="text"
                            class="uppercase form-control"
                            wire:model="kode">
                    </div>

                    <div class="block w-2/5">
                        <label for="" class="text-xs form-label">Limit/Batas</label>
                        <input name=""
                            type="text"
                            class="form-control"
                            wire:model="antrian">
                    </div>

                    <div class="items-start w-1/5 pt-2 form-check">
                        <input name="aktif"
                            type="checkbox"
                            class="form-check-input"
                            wire:model="aktif">
                        <label class="form-check-label" for="">Aktif</label>
                    </div>
                </div>

                <div class="w-full">
                    <label for="" class="text-xs form-label">Deskripsi</label>
                    <textarea name="" class="form-control" wire:model="deskripsi" rows="3"></textarea>
                </div>
            </div>

            {{-- <div class="text-right modal-footer"> --}}
                <x-slot name="footer">
                <a href="javascript:;"
                    data-dismiss="modal"
                    class="w-20 mr-1 btn btn-outline-secondary">Cancel</a>

                <a href="javascript:;"
                    data-dismiss="modal"
                    wire:click.prevent="store"
                    class="w-20 btn btn-primary">Send</a>
                </x-slot>
            </x-midone-modal-form>
            {{-- </div> --}}
        {{-- </div>
    </div>
</div> --}}
<!-- END: Modal Content -->
