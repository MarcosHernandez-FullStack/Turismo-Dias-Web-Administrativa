@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                @if ($form == 'detail')
                    Detalle Ambiente
                @else
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Ambiente
                @endif
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">脳</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-md-6">
                <label for="nombre" class="form-label">
                    Nombre
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="nombre" wire:model='ambiente.nombre'>
                @error('ambiente.nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="tipo" class="form-label">
                    Tipos de Ambiente
                </label>
                <select class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="tipo"  wire:model='ambiente.tipo'>
                    <option value="">Seleccionar una opci贸n</option>
                    <option value="1">Oficina</option>
                    <option value="2">Terrapuerto</option>
                    <option value="3">Almacen</option>
                </select>
                @error('ambiente.tipo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="coordenada_latitud" class="form-label">
                    Coordenada latitud
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="coordenada_latitud" wire:model='ambiente.coordenada_latitud'>
                @error('ambiente.coordenada_latitud')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

             <div class="form-group col-md-6">
                <label for="coordenada_longitud" class="form-label">
                    Coordenada longitud
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="coordenada_longitud" wire:model='ambiente.coordenada_longitud'>
                @error('ambiente.coordenada_longitud')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="direccion" class="form-label">
                    Direccion
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="direccion" wire:model='ambiente.direccion'>
                @error('ambiente.direccion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="horario_atencion" class="form-label">
                    Horario atencion
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" @if ($form == 'detail') disabled @endif id="horario_atencion" wire:model='ambiente.horario_atencion'>
                </textarea>
                @error('ambiente.horario_atencion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="telefono" class="form-label">
                    Telefono
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="telefono" wire:model='ambiente.telefono'>
                @error('ambiente.telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="ciudad_id" class="form-label">
                    Ciudad
                </label>
                <select class="form-control form-control-sm rounded-pill" @if ($form == 'detail') disabled @endif id="ciudad_id" wire:model='ambiente.ciudad_id'>
                    <option value="">Seleccionar una opci贸n</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->descripcion }}</option>
                    @endforeach
                </select>
                @error('ambiente.ciudad_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            @if ($form != 'detail')
            <button type="button" class="btn btn-sm rounded-pill btn-info"
                wire:click="{{ $form == 'create' ? 'save' : 'update' }}"
                > <i class="fas fa-save"></i> {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
            @endif
        </div>
    </form>
@endsection





