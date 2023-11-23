<form>
    <div class="modal-header bg-info text-light">
        <h5 class="modal-title">
            {{ $form == 'create' ? 'Crear' : 'Editar' }} Ciudad
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" wire:model='ciudad.descripcion'
                        class="form-control @error('ciudad.descripcion') is-invalid @enderror" id="descripcion"
                        rows="2" placeholder="Ingresar Descripción de la Ciudad">
                    @error('ciudad.descripcion')
                        <span id="descripcion-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        @if ($this->form == 'update')
            <div class="row">
                <div class="col-12">
                    @livewire('sub-ciudad.sub-ciudad-component')
                </div>
            </div>
        @endif

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i
                class="fas fa-times"></i> Cerrar</button>
        <button type="button" class="btn btn-sm rounded-pill btn-info" wire:loading.attr="disabled" wire:target="save"
            wire:click="save"> <i class="fas fa-save"></i>
            {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
    </div>
</form>
