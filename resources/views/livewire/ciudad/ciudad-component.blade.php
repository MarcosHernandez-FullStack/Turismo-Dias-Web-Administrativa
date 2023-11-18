@section('content-header')
    <div class="row ">
        <div class="col-12">
            <div class="m-0 card card-default color-palette-box">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <h1 class="card-title">Configuración de Página Web</h1> --}}
                            <h5><i style="color: #17a2b8" class="fa-solid fa-map-location-dot mr-1"></i>
                                <b style="color: rgb(48, 48, 48)">CIUDADES</b>
                            </h5>

                        </div>
                        <!--div class="col-sm-6">
                                                                                                    <ol class="breadcrumb float-sm-right">
                                                                                                        <li class="breadcrumb-item"><a href="{{ route('bienvenido') }}">Inicio</a></li>
                                                                                                        <li class="breadcrumb-item active">Ciudades</li>
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
                        <div class="row ">
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="m-0">Buscar</label><input type="search"
                                                class="form-control form-control-sm ml-1 rounded-pill"
                                                placeholder="Buscar por descripción" wire:model="search"
                                                aria-controls="example1">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 ml-auto">
                                        <div class="form-group d-flex justify-content-end">
                                            <button type="button" class="btn btn-info btn-sm rounded-pill"
                                                wire:click="showModal('form', 'create')">
                                                <i class="fas fa-plus"></i>
                                                Nueva Ciudad
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-sm m-0 rounded-pill">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px">#</th>
                                                    <th>Descripción</th>
                                                    <th>N° Distritos</th>
                                                    <th>Estado</th>
                                                    <th>Editar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($ciudades as $key => $ciudad)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $ciudad->descripcion }}</td>
                                                        <td>{{ $ciudad->subciudades->count() }} </td>
                                                        <td><span role="button"
                                                                class="badge rounded-pill bg-{{ $ciudad->estado == '1' ? 'success' : 'warning' }}"
                                                                wire:click='cambiarEstado({{ $ciudad->id }})'>{{ $ciudad->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                        </td>
                                                        <td><button type="button"
                                                                class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                                wire:click="edit({{ $ciudad->id }})"><i
                                                                    class="fas fa-pen"></i>
                                                            </button></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No hay registros
                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('layouts.footer-listado', ['elementosListado' => $ciudades])
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalCiudad" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('livewire.ciudad.form')
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModalCiudad', event => {
            $("#modalCiudad").modal('hide');
        });
        window.addEventListener('showModalCiudad', event => {
            $("#modalCiudad").modal('show');
        });
    </script>
@endpush
