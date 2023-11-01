<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', [
                            'label' => 'Termino Condicione',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por seccion del termino condicion',
                        ])
                        <div class="row my-1">

                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Seccion</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Descripcion</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Estado</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($termino_condiciones as $key => $termino_condicion)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $termino_condicion->seccion }}</td>
                                                <td>{{ $termino_condicion->descripcion }}</td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $termino_condicion->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='cambiarEstado({{ $termino_condicion->id }})'>{{ $termino_condicion->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        data-toggle="modal" data-target="#modal_usuario"
                                                        wire:click="edit({{ $termino_condicion->id }})"><i
                                                            class="fas fa-pen"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <h4>No hay registros</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $termino_condiciones])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.termino_condicion.$vista")
</div>
