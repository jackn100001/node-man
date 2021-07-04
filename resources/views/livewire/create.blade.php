<div>
    <div class="modal d-block" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button wire:click.prevent="closeModalPopover()" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input wire:model="name" type="text" class="form-control" id="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                         </div>
                         <div class="form-group">
                            <label for="ip_address">IP Address:</label>
                            <input wire:model="ip_address" type="text" class="form-control" id="ip_address">
                             @error('ip_address') <span class="text-danger">{{ $message }}</span> @enderror
                         </div>
                         <div class="form-group">
                            <label for="hostname">Hostname:</label>
                            <input wire:model="hostname" type="text" class="form-control" id="hostname">
                            @error('hostname') <span class="text-danger">{{ $message }}</span> @enderror
                         </div>
                {{--</div>
                <div class="modal-footer"> --}}
                        <button wire:click.prevent="closeModalPopover()" class="btn btn-secondary">Close</button>
                        <button wire:click.prevent="store()" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

