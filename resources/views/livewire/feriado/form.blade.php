@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Feriado
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="razon">Razón</label>
                        <input type="text" wire:model='feriado.razon'
                            class="form-control @error('feriado.razon') is-invalid @enderror" id="razon"
                            placeholder="Ingresar Razón del Feriado">
                        @error('feriado.razon')
                            <span id="razon-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" wire:model='feriado.fecha_inicio'
                            class="form-control @error('feriado.fecha_inicio') is-invalid @enderror" id="fecha_inicio"
                            placeholder="Ingresar Fecha de Inicio del Feriado">
                        @error('feriado.fecha_inicio')
                            <span id="fecha_inicio-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" wire:model='feriado.fecha_fin'
                            class="form-control @error('feriado.fecha_fin') is-invalid @enderror" id="fecha_fin"
                            placeholder="Ingresar Fecha de Fin del Feriado (Opcional)">
                        @error('feriado.fecha_fin')
                            <span id="fecha_fin-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i
                    class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-sm rounded-pill btn-info"
                wire:click="save"> <i class="fas fa-save"></i>
                {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection
