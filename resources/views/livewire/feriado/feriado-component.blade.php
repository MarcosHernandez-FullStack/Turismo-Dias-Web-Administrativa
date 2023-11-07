@section('content-header')
    <div class="row mb-2">
        <div class="col-12">
            <div class="card card-default color-palette-box">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <h1 class="card-title">Configuración de Página Web</h1> --}}
                            <h5><i style="color: #17a2b8" class="fa-solid fa-calendar-days nav-icon"></i>
                                <b style="color: rgb(48, 48, 48)">CALENDARIO DE EVENTOS</b>
                            </h5>

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('bienvenido') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Calendario de Eventos</li>
                            </ol>
                        </div>
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
                <div class="card-body p-3">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row my-1">
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="searchRazon">Buscar por Razón</label>
                                    <input type="text" wire:model='searchRazon' class="form-control form-control-sm"
                                        id="searchRazon" placeholder="Buscar por razón">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="searchFechaInicio">Buscar por Fecha de
                                        Inicio</label>
                                    <input type="date" wire:model='searchFechaInicio'
                                        class="form-control form-control-sm" id="searchFechaInicio">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="searchMes">Buscar por mes</label>
                                    <select class="form-select form-control  form-control-sm" id="searchMes"
                                        wire:model='searchMes'>
                                        <option value="0">Todos</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="searchAnio">Buscar por año</label>
                                    <select class="form-select form-control  form-control-sm" id="searchAnio"
                                        wire:model='searchAnio'>
                                        <option value="0">Todos</option>
                                        @forelse ($anios as $key => $anio)
                                            <option value="{{ $anio }}">{{ $anio }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 ml-auto d-flex justify-content-end  align-items-center ">
                                <div class="form-group ">
                                    <button type="button" class="btn btn-info btn-sm rounded-pill" data-toggle="modal"
                                        data-target="#modal_usuario" wire:click="showModal('form', 'create')">
                                        <i class="fas fa-plus"></i>
                                        Nuevo Feriado
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="row my-1 justify-content-center">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">Razón</th>
                                            <th rowspan="1" colspan="1">Fecha de Inicio</th>
                                            <th rowspan="1" colspan="1">Fecha de Fin</th>
                                            <th rowspan="1" colspan="1">Estado</th>
                                            <th style="width:30px" rowspan="1" colspan="1">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($feriados as $key => $feriado)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $feriado->razon }}</td>
                                                <td>{{ \Carbon\Carbon::parse($feriado->fecha_inicio)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($feriado->fecha_fin)->format('d/m/Y') }}</td>
                                                <td><span role="button"
                                                        class="badge rounded-pill bg-{{ $feriado->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='confirmarCambioEstado({{ $feriado->id }})'>{{ $feriado->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        wire:click="edit({{ $feriado->id }})"><i
                                                            class="fas fa-pen"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <h4>No hay registros</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('layouts.footer-listado', ['elementosListado' => $feriados])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("livewire.feriado.$vista")
</div>
