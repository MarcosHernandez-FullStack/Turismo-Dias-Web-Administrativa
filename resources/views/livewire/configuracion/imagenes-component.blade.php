<div style="height: 100%!important;">
    <div class="small-box bg-danger" style="height: 100%!important;cursor: pointer;" wire:click="showModal">
        <div class=" inner">
            <h3>Multimedia</h3>

            <p>Edita las imágenes y video que se mostrarán en la página web</p>
        </div>
        <div class="icon">
            <i class="fa-regular fa-images"></i>
        </div>
        <a class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    <div class="modal fade @if ($verModal) show @endif" id="ImagenesModal" tabindex="-1"
        role="dialog" aria-labelledby="ImagenesModalTitle" aria-hidden="true"
        @if ($verModal) style="padding-right: 17px; display: block;" @endif>
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="ImagenesModalTitle">Multimedia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1 bg-info">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if ($tab == 'ruta_logo_tab') active @endif"
                                        id="ruta_logo_tab" data-toggle="pill" href="#ruta_logo_tabContent"
                                        wire:click="cambiarTab('ruta_logo_tab');" role="tab"
                                        aria-controls="ruta_logo_tabContent" aria-selected="true">Logo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if ($tab == 'ruta_foto_principal_tab') active @endif"
                                        id="ruta_foto_principal_tab" data-toggle="pill"
                                        href="#ruta_foto_principal_tabContent"
                                        wire:click="cambiarTab('ruta_foto_principal_tab');" role="tab"
                                        aria-controls="ruta_foto_principal_tabContent"
                                        aria-selected="true">Principal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @if ($tab == 'ruta_video_tab') active @endif"
                                        id="ruta_video_tab" data-toggle="pill" href="#ruta_video_tabContent"
                                        wire:click="cambiarTab('ruta_video_tab');" role="tab"
                                        aria-controls="ruta_video_tabContent" aria-selected="false">Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @if ($tab == 'ruta_foto_header_seccion_tab') active @endif"
                                        id="ruta_foto_header_seccion_tab" data-toggle="pill"
                                        href="#ruta_foto_header_seccion_tabContent"
                                        wire:click="cambiarTab('ruta_foto_header_seccion_tab');" role="tab"
                                        aria-controls="ruta_foto_header_seccion_tabContent"
                                        aria-selected="false">Encabezado</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade @if ($tab == 'ruta_logo_tab') active show @endif"
                                    id="ruta_logo_tabContent" role="tabpanel"
                                    aria-labelledby="ruta_logo_tabContent-tab">
                                    <div class="form-group">
                                        <label>Imagen de Logo</label>
                                        <div wire:ignore x-data x-init="initFotoLogo($refs.ruta_logo)">
                                            <input wire:model='ruta_logo' type="file" x-ref="ruta_logo"
                                                name="ruta_logo">

                                        </div>
                                        @error('ruta_logo')
                                            <span class="error invalid-feedback"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="contenedor-imagen" style="height: 300px!important;">
                                                @if (isset($ruta_logo))
                                                    <img src="{{ $ruta_logo->temporaryUrl() }}" alt="...">
                                                @elseif (isset($configuracion->ruta_logo))
                                                    <img src="{{ Storage::url($configuracion->ruta_logo) }}"
                                                        alt="...">
                                                @else
                                                    <img src="{{ asset('assets/img/2835x1890.png') }}" alt="...">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade @if ($tab == 'ruta_foto_principal_tab') active show @endif"
                                    id="ruta_foto_principal_tabContent" role="tabpanel"
                                    aria-labelledby="ruta_foto_principal_tabContent-tab">
                                    <div class="form-group">
                                        <label>Imagen de Página Principal</label>
                                        <div wire:ignore x-data x-init="initFotoPrincipal($refs.input_ruta_foto_principal)">
                                            <input wire:model='ruta_foto_principal' type="file"
                                                x-ref="input_ruta_foto_principal" name="ruta_foto_principal">

                                        </div>
                                        @error('ruta_foto_principal')
                                            <span class="error invalid-feedback"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="contenedor-imagen-principal" style="height: 378px!important;">
                                                @if (isset($ruta_foto_principal))
                                                    <img src="{{ $ruta_foto_principal->temporaryUrl() }}"
                                                        alt="...">
                                                @elseif (isset($configuracion->ruta_foto_principal))
                                                    <img src="{{ Storage::url($configuracion->ruta_foto_principal) }}"
                                                        alt="...">
                                                @else
                                                    <img src="{{ asset('assets/img/2835x1890.png') }}" alt="...">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade @if ($tab == 'ruta_video_tab') active show @endif"
                                    id="ruta_video_tabContent" role="tabpanel"
                                    aria-labelledby="ruta_video_tabContent-tab">
                                    <div class="form-group">
                                        <label for="ruta_video">Video de bienvenida</label>
                                        <input type="text" wire:model='configuracion.ruta_video'
                                            class="form-control @error('configuracion.ruta_video') is-invalid @enderror"
                                            id="ruta_video" placeholder="Ingresar URL del video a mostrar">
                                        @error('configuracion.ruta_video')
                                            <span id="ruta_video-error"
                                                class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="contenedor-video">
                                                @if (isset($this->configuracion->ruta_video))
                                                    {{-- !! $this->configuracion->ruta_video !! --}}
                                                    <iframe width="640" height="360"
                                                        src="{{ $this->configuracion->ruta_video }}" frameborder="0"
                                                        allowfullscreen></iframe>
                                                    </video>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade @if ($tab == 'ruta_foto_header_seccion_tab') active show @endif"
                                    id="ruta_foto_header_seccion_tabContent" role="tabpanel"
                                    aria-labelledby="ruta_foto_header_seccion_tabContent-tab">
                                    <div class="form-group">
                                        <label>Imagen de los Encabezados</label>
                                        <div wire:ignore x-data x-init="initFotoHeader($refs.input_ruta_foto_header_seccion)">
                                            <input wire:model='ruta_foto_header_seccion' type="file"
                                                x-ref="input_ruta_foto_header_seccion"
                                                name="ruta_foto_header_seccion">

                                        </div>
                                        @error('ruta_foto_header_seccion')
                                            <span class="error invalid-feedback"
                                                style="display: block;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="contenedor-imagen-header" style="height: 423px!important;">
                                                @if (isset($ruta_foto_header_seccion))
                                                    <img src="{{ $ruta_foto_header_seccion->temporaryUrl() }}"
                                                        alt="...">
                                                @elseif (isset($configuracion->ruta_foto_header_seccion))
                                                    <img src="{{ Storage::url($configuracion->ruta_foto_header_seccion) }}"
                                                        alt="...">
                                                @endif
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
                            class="fas fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-sm rounded-pill btn-info" wire:click="save"><i
                            class="fas fa-save" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModalImagenes', event => {
            $("#ImagenesModal").modal('hide');
        });
        window.addEventListener('showModalImagenes', event => {
            $("#ImagenesModal").modal('show');
        });

        let fotoLogo, fotoPrincipal, fotoHeader;

        function initFotoLogo(inputRef) {
            fotoLogo = FilePond.create(inputRef, {
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
                labelFileTypeNotAllowed: 'Tipo de archivo inválido',
                fileValidateTypeLabelExpectedTypes: 'Inserte una imagen',
                //VALIDACION DE TAMAÑO
                maxFileSize: '1MB',
                labelMaxFileSizeExceeded: 'El archivo es muy grande',
                labelMaxFileSize: 'El tamaño máximo permitido es de {filesize}',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('ruta_logo', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('ruta_logo', filename, load)

                    },
                },
            });
        };

        function initFotoPrincipal(inputRef) {
            fotoPrincipal = FilePond.create(inputRef, {
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
                labelFileTypeNotAllowed: 'Tipo de archivo inválido',
                fileValidateTypeLabelExpectedTypes: 'Inserte una imagen',
                //VALIDACION DE TAMAÑO
                maxFileSize: '1MB',
                labelMaxFileSizeExceeded: 'El archivo es muy grande',
                labelMaxFileSize: 'El tamaño máximo permitido es de {filesize}',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('ruta_foto_principal', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('ruta_foto_principal', filename, load)

                    },
                },
            });
        };

        function initFotoHeader(inputRef) {
            fotoHeader = FilePond.create(inputRef, {
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
                labelFileTypeNotAllowed: 'Tipo de archivo inválido',
                fileValidateTypeLabelExpectedTypes: 'Inserte una imagen',
                //VALIDACION DE TAMAÑO
                maxFileSize: '1MB',
                labelMaxFileSizeExceeded: 'El archivo es muy grande',
                labelMaxFileSize: 'El tamaño máximo permitido es de {filesize}',
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('ruta_foto_header_seccion', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('ruta_foto_header_seccion', filename, load)

                    },
                },
            });
        };

        window.addEventListener('removerImagenes', event => {
            fotoPrincipal.removeFiles();
            fotoHeader.removeFiles();
            fotoLogo.removeFiles();
        });
    </script>
@endpush
