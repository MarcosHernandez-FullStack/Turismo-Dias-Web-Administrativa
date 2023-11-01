@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Termino Condicion
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-md-6">
                <label for="seccion" class="form-label">
                    Seccion
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" id="seccion" wire:model='termino_condicion.seccion'>
                @error('termino_condicion.seccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="descripcion" class="form-label">
                    Descripcion
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" id="descripcion" wire:model='termino_condicion.descripcion'>
                @error('termino_condicion.descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-sm rounded-pill btn-info"
                wire:click="{{ $form == 'create' ? 'save' : 'update' }}"
                > <i class="fas fa-save"></i> {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection





