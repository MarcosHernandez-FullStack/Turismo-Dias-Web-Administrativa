@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                Ver Reclamo
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1 bg-info text-light">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if ($tab == 'reclamante') active @endif" id="reclamante"
                                data-toggle="pill" href="#reclamanteContent" wire:click="cambiarTab('reclamante');"
                                role="tab" aria-controls="reclamanteContent" aria-selected="true">Datos del
                                reclamante</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if ($tab == 'bien_servicio') active @endif" id="bien_servicio"
                                data-toggle="pill" href="#bien_servicioContent" wire:click="cambiarTab('bien_servicio');"
                                role="tab" aria-controls="bien_servicioContent"
                                aria-selected="false">Producto/Servicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  @if ($tab == 'detalle') active @endif" id="detalle"
                                data-toggle="pill" href="#detalleContent" wire:click="cambiarTab('detalle');" role="tab"
                                aria-controls="detalleContent" aria-selected="false">Detalle del Reclamo</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade @if ($tab == 'reclamante') active show @endif"
                            id="reclamanteContent" role="tabpanel" aria-labelledby="reclamanteContent-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nombre_completo_consumidor">Nombre del Reclamante</label>
                                        <input type="text" value="{{ $this->reclamo->nombre_completo_consumidor }}"
                                            disabled class="form-control" id="nombre_completo_consumidor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="documento_identidad_consumidor">DNI / CE</label>
                                        <input type="text" value="{{ $this->reclamo->documento_identidad_consumidor }}"
                                            disabled class="form-control" id="documento_identidad_consumidor">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="telefono_consumidor">Teléfono</label>
                                        <input type="text" value="{{ $this->reclamo->telefono_consumidor }}" disabled
                                            class="form-control" id="telefono_consumidor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email_consumidor">Correo Electrónico</label>
                                        <input type="text" value="{{ $this->reclamo->email_consumidor }}" disabled
                                            class="form-control" id="email_consumidor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="direccion_consumidor">Dirección</label>
                                        <input type="text" value="{{ $this->reclamo->direccion_consumidor }}" disabled
                                            class="form-control" id="direccion_consumidor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="nombre_completo_apoderado_consumidor">Tutor (Menores de Edad)</label>
                                        <input type="text"
                                            value="{{ $this->reclamo->nombre_completo_apoderado_consumidor }}" disabled
                                            class="form-control" id="nombre_completo_apoderado_consumidor">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if ($tab == 'bien_servicio') active show @endif"
                            id="bien_servicioContent" role="tabpanel" aria-labelledby="bien_servicioContent-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tipo_bien">Tipo</label>
                                        <input type="text"
                                            value="{{ $this->reclamo->tipo_bien == 1 ? 'Producto' : 'Servicio' }}" disabled
                                            class="form-control" id="tipo_bien">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="monto_reclamado_bien">Monto</label>
                                        <input type="text" value="{{ $this->reclamo->monto_reclamado_bien }}" disabled
                                            class="form-control" id="monto_reclamado_bien">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="descripcion_bien">Descripción</label>
                                        <input type="text" value="{{ $this->reclamo->descripcion_bien }}" disabled
                                            class="form-control" id="descripcion_bien">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if ($tab == 'detalle') active show @endif"
                            id="detalleContent" role="tabpanel" aria-labelledby="detalleContent-tab">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_reclamacion_detalle">Tipo</label>
                                        <input type="text"
                                            value="{{ $this->reclamo->tipo_reclamacion_detalle == 1 ? 'Reclamo' : 'Queja' }}"
                                            disabled class="form-control" id="tipo_reclamacion_detalle">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="created_at">Fecha</label>
                                        <input type="text"
                                            value="{{ \Carbon\Carbon::parse($this->reclamo->created_at)->format('d/m/Y') }}"
                                            disabled class="form-control" id="created_at">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="descripcion_reclamacion_detalle">Detalle</label>
                                        <textarea disabled class="form-control" id="descripcion_reclamacion_detalle" rows="2">{{ $this->reclamo->descripcion_reclamacion_detalle }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="pedido_reclamacion_detalle">Pedido</label>
                                        <textarea disabled class="form-control" id="pedido_reclamacion_detalle" rows="2">{{ $this->reclamo->pedido_reclamacion_detalle }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group clearfix">
                                        <div class="icheck-info d-inline">
                                            <input type="radio" id="estado1" name="r1" value="1"
                                                checked="" wire:model="reclamo.estado">
                                            <label for="estado1">
                                                En espera
                                            </label>
                                        </div>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" id="estado2" name="r1" value="2"
                                                wire:model="reclamo.estado">
                                            <label for="estado2">
                                                Atender
                                            </label>
                                        </div>
                                        <div class="icheck-info d-inline">
                                            <input type="radio" id="estado0" name="r1" value="0"
                                                wire:model="reclamo.estado">
                                            <label for="estado0">
                                                Archivar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i
                    class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-sm rounded-pill btn-info" wire:click="save"> <i
                    class="fas fa-save"></i>
                Actualizar</button>
        </div>
    </form>
@endsection
