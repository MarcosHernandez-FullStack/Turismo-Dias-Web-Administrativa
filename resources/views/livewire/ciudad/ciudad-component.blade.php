<div>
    <div id="accordionCiudad">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseCiudad">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-map-location-dot nav-icon"></i> Ciudades
                            </div>
                            <i class="fa-solid fa-arrows-up-down"></i>
                        </div>
                    </a>
                </h4>
            </div>
            <div wire:ignore.self id="collapseCiudad" class="collapse" data-parent="#accordionCiudad">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="m-0">Buscar</label><input type="search"
                                            class="form-control form-control-sm ml-1 rounded-pill"
                                            placeholder="Buscar por descripción" wire:model="search" aria-controls="example1">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-8">
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
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px">#</th>
                                                        <th>Descripción</th>
                                                        <th style="width:150px">Estado</th>
                                                        <th style="width:100px">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($ciudades as $key => $ciudad)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $ciudad->descripcion }}</td>
                                                            <td><span role="button"
                                                                    class="badge rounded-pill bg-{{ $ciudad->estado == '1' ? 'success' : 'warning' }}"
                                                                    wire:click='confirmarCambioEstado({{ $ciudad->id }})'>{{ $ciudad->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                            </td>
                                                            <td><button type="button"
                                                                    class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                                    wire:click="edit({{ $ciudad->id }})"><i
                                                                        class="fas fa-pen"></i>
                                                                </button></td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4">No hay registros</td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="pl-2 pr-2">
                                            @include('layouts.footer-listado', [
                                                'elementosListado' => $ciudades,
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
