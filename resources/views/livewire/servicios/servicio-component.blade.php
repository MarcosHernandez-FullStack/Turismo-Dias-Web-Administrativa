@section('content-header')
    <div class="row ">
        <div class="col-12">
            <div class="m-0 card card-default color-palette-box">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <h1 class="card-title">Configuración de Página Web</h1> --}}
                            <h5><i style="color: #17a2b8" class="fa-solid fa-bus mr-1"></i>
                                <b style="color: rgb(48, 48, 48)">SERVICIOS</b>
                            </h5>

                        </div>
                        <!--div class="col-sm-6">
                                                                                                                                <ol class="breadcrumb float-sm-right">
                                                                                                                                    <li class="breadcrumb-item"><a href="{{ route('bienvenido') }}">Inicio</a></li>
                                                                                                                                    <li class="breadcrumb-item active">Servicios</li>
                                                                                                                                </ol>
                                                                                                                            </div-->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', [
                            'label' => 'Servicio',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por nombre del servicio',
                        ])
                        <div class="row my-1">

                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Nombre</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Imagen</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Estado</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($servicios as $key => $servicio)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $servicio->nombre }}</td>
                                                <td><button type="button"
                                                        class="btn btn-sm btn-info rounded-pill popover-btn"
                                                        data-toggle="popover" data-html="true"
                                                        data-content="<img class='w-100' src='{{ Storage::url($servicio->ruta_foto) }}' alt='...'>"><i
                                                            class="fa-regular fa-eye"></i></button>
                                                </td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $servicio->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='cambiarEstado({{ $servicio->id }})'>{{ $servicio->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        wire:click="edit({{ $servicio->id }})"><i
                                                            class="fas fa-pen"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <h4>No hay registros</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $servicios])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.servicios.$vista")
</div>
@push('scripts')
    <script>
        window.addEventListener('inicializaPopovers', function(event) {
            $('[data-toggle="popover"]').popover();

        });


        $(document).on('click', function(e) {
            $('[data-toggle="popover"]').each(function() {
                // Comprobar si el clic no ocurrió dentro del popover
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e
                        .target).length === 0) {
                    // Ocultar el popover
                    $(this).popover('hide');
                }
            });
        });
        let fotoServicio;

        function initFotoServicio(inputRef) {
            fotoServicio = FilePond.create(inputRef, {
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
                maxFileSize: '500KB',
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
            });
        };

        window.addEventListener('removerImagenes', event => {
            fotoServicio.removeFiles();
        });
    </script>
@endpush
