<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card card-default color-palette-box">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{--  <h1 class="card-title">Configuración de Página Web</h1> --}}
                                    <h5><i style="color: #17a2b8" class="fas fa-laptop-house  mr-1"></i>
                                        <b style="color: rgb(48, 48, 48)">TERMINOS Y CONDICIONES</b></h5>

                                </div>
                                {{--  <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ route('bienvenido') }}">Inicio</a></li>
                                        <li class="breadcrumb-item active">Configuración</li>
                                    </ol>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg m-0 px-2" style="border-radius: 25px">
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        @include('layouts.header-listado', [
                            'label' => 'Termino Condicion',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por campos del termino condicion',
                        ])
                        <div class="row my-1">

                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th style="width:60px" rowspan="1" colspan="1">Orden</th>
                                            <th style="width:75px" rowspan="1" colspan="1">Seccion</th>
                                            <th style="width:300px" rowspan="1" colspan="1">Descripcion</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Estado</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($termino_condiciones as $key => $termino_condicion)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if ($termino_condicion->orden != 1)
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary rounded-pill"
                                                            wire:click="ordenamiento('up', {{ $termino_condicion->id }})"><i
                                                                class="fas fa-arrow-up"></i></button>
                                                        @endif
                                                        <span class="btn btn-sm btn-outline-secondary rounded-pill"
                                                            style="cursor: default">{{ $termino_condicion->orden }}</span>
                                                        @if ($termino_condicion->orden != $termino_condiciones->total())
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary rounded-pill"
                                                            wire:click="ordenamiento('down', {{ $termino_condicion->id }})"><i
                                                                class="fas fa-arrow-down"></i></button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $termino_condicion->seccion }}</td>
                                                <td>{!! $termino_condicion->descripcion !!}</td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $termino_condicion->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='confirmarCambioEstado({{ $termino_condicion->id }})'>{{ $termino_condicion->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
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
                                                <td colspan="5" class="text-center">
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