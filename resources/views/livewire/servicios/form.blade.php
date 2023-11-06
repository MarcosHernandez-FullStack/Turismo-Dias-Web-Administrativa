@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Servicio
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" wire:model='servicio.nombre'
                            class="form-control @error('servicio.nombre') is-invalid @enderror" id="nombre"
                            placeholder="Ingresar Nombre del Servicio">
                        @error('servicio.nombre')
                            <span id="nombre-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea wire:model='servicio.descripcion' class="form-control @error('servicio.descripcion') is-invalid @enderror"
                            id="descripcion" rows="3" placeholder="Ingresar Descripción del Servicio"></textarea>
                        @error('servicio.descripcion')
                            <span id="descripcion-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Imagen del Servicio</label>
                        <div wire:ignore x-data x-init="FilePond.create($refs.input_ruta_foto, {
                            labelIdle: 'Arrastra y suelta tus archivos, o <span class=\'filepond--label-action\'> Busca </span>',
                            credits: {},
                            allowMultiple: false,
                            acceptedFileTypes: ['image/*'],
                            checkValidity: true,
                            labelFileLoading: 'Cargando',
                            labelFileLoadError: 'Error durante la carga',
                            labelFileProcessing: 'Subiendo',
                            labelFileProcessingComplete: 'Completado',
                            labelFileProcessingAborted: 'Cancelado',
                            labelTapToUndo: 'Presione para revertir',
                            labelTapToCancel: 'Presione para cancelar',
                            //VALIDACION DE TAMAÑO
                            maxFileSize: '1MB',
                            labelMaxFileSizeExceeded: 'El archivo es muy grande',
                            labelMaxFileSize: 'El tamaño máximo permitido es de {filesize}',
                            server: {
                                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                    @this.upload('ruta_foto', file, load, error, progress)
                                },
                                revert: (filename, load) => {
                                    @this.removeUpload('ruta_foto', filename, load)

                                },
                            },
                        });">
                            <input wire:model='ruta_foto' type="file" x-ref="input_ruta_foto" name="ruta_foto">

                        </div>
                        @error('ruta_foto')
                            <span class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row p-0 m-0">
                        <div class="col-12 p-0 m-0 d-flex justify-content-center">
                            <div class="contenedor-imagen" style="height: 200px!important;width: 280px!important;">
                                @if (isset($ruta_foto))
                                <img src="{{ $ruta_foto->temporaryUrl() }}" alt="...">
                                @elseif (isset($this->servicio->ruta_foto))
                                <img src="{{ Storage::url($this->servicio->ruta_foto) }}"
                                  alt="...">
                                @else
                                <img src="{{ asset('assets/img/350x250.png') }}" alt="...">
                                @endif
                              </div>
                        </div>
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
