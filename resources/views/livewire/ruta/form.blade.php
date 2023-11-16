@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Ruta
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-md-6">
                <label for="hora_salida" class="form-label">
                    Hora salida
                </label>
                <input type="time" class="form-control form-control-sm rounded-pill" id="hora_salida" wire:model='ruta.hora_salida'>
                @error('ruta.hora_salida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="hora_llegada" class="form-label">
                    Hora llegada
                </label>
                <input type="time" class="form-control form-control-sm rounded-pill" id="hora_llegada" wire:model='ruta.hora_llegada'>
                @error('ruta.hora_llegada')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="ciudad_origen_id" class="form-label">
                    Ciudad origen
                </label>
                <select class="form-control form-control-sm rounded-pill" id="ciudad_origen_id" wire:model='ruta.ciudad_origen_id'>
                    <option value="">Seleccionar una opción</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->descripcion }}</option>
                    @endforeach
                </select>
                @error('ruta.ciudad_origen_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="ciudad_destino_id" class="form-label">
                    Ciudad destino
                </label>
                <select class="form-control form-control-sm rounded-pill" id="ciudad_destino_id" wire:model='ruta.ciudad_destino_id'>
                    <option value="">Seleccionar una opción</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->descripcion }}</option>
                    @endforeach
                </select>
                @error('ruta.ciudad_destino_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if (count($sub_ciudades_origenes))
            <div class="form-group col-md-6">
                <label for="sub_ciudad_origen_id" class="form-label">
                    Distrito de Ciudad origen
                </label>
                <select class="form-control form-control-sm rounded-pill" id="sub_ciudad_origen_id" wire:model='ruta.sub_ciudad_origen_id'>
                    <option value="">Seleccionar una opción</option>
                    @foreach ($sub_ciudades_origenes as $sub_ciudad)
                        <option value="{{ $sub_ciudad->id }}">{{ $sub_ciudad->descripcion }}</option>
                    @endforeach
                </select>
                @error('ruta.sub_ciudad_origen_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif
            @if (count($sub_ciudades_destinos))
            <div class="form-group col-md-6">
                <label for="sub_ciudad_destino_id" class="form-label">
                    Distrito de Ciudad destino
                </label>
                <select class="form-control form-control-sm rounded-pill" id="sub_ciudad_destino_id" wire:model='ruta.sub_ciudad_destino_id'>
                    <option value="">Seleccionar una opción</option>
                    @foreach ($sub_ciudades_destinos as $sub_ciudad)
                        <option value="{{ $sub_ciudad->id }}">{{ $sub_ciudad->descripcion }}</option>
                    @endforeach
                </select>
                @error('ruta.sub_ciudad_destino_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @endif
            <div class="form-group col-md-6">
                <label for="tipo_bus_id" class="form-label">
                    Tipo bus
                </label>
                <select class="form-control form-control-sm rounded-pill" id="tipo_bus_id" wire:model='ruta.tipo_bus_id'>
                    <option value="">Seleccionar una opción</option>
                    @foreach ($tipo_buses as $tipo_bus)
                        <option value="{{ $tipo_bus->id }}">{{ $tipo_bus->nombre }}</option>
                    @endforeach
                </select>
                @error('ruta.tipo_bus_id')
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





