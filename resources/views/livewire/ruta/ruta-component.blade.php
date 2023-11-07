<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="card card-default color-palette-box">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{--  <h1 class="card-title">Configuración de Página Web</h1> --}}
                            <h5><i style="color: #17a2b8" class="fa-solid fa-route  mr-1"></i>
                                 <b style="color: rgb(48, 48, 48)">RUTAS: SALIDAS, LLEGADAS Y TIPOS DE BUSES</b></h5>

                        </div>

                    </div>

                </div>
            </div>

            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12">
                            @livewire('tipo-bus.tipo-bus-component')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @livewire('ciudad.ciudad-component')
                        </div>
                    </div>
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', [
                            'label' => 'Ruta',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por hora_salida de la ruta',
                        ])
                        <div class="row my-1">

                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Hora salida</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Hora llegada</th>
                                            <th style="width:200px" rowspan="1" colspan="1">Ciudad origen</th>
                                            <th style="width:200px" rowspan="1" colspan="1">Ciudad destino</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Tipo bus</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Estado</th>
                                            <th style="width:100px" rowspan="1" colspan="1">Opcciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rutas as $key => $ruta)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $ruta->hora_salida}}</td>
                                                <td>{{ $ruta->hora_llegada}}</td>
                                                <td>{{ $ruta->ciudad_origen->descripcion }}</td>
                                                <td>{{ $ruta->ciudad_destino->descripcion }}</td>
                                                <td>{{ $ruta->tipo_bus->nombre }}</td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $ruta->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='confirmarCambioEstado({{ $ruta->id }})'>{{ $ruta->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        data-toggle="modal" data-target="#modal_usuario"
                                                        wire:click="edit({{ $ruta->id }})"><i
                                                            class="fas fa-pen"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    <h4>No hay registros</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $rutas])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.ruta.$vista")
</div>
