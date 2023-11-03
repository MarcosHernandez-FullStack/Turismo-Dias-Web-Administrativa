@section('content-header')
<div class="row mb-2">
    <div class="col-12">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- <h1 class="card-title">Configuración de Página Web</h1> --}}
                        <h5><i style="color: #17a2b8" class="fa-solid fa-book-bookmark mr-1"></i>
                            <b style="color: rgb(48, 48, 48)">LIBRO DE RECLAMACIONES</b>
                        </h5>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('bienvenido') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Libro de Reclamaciones</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg m-0 " style="border-radius: 25px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Carpetas</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item active" style="cursor: pointer;" wire:click="cambiarFiltroEstado('1')">
                                            <a  class="nav-link">
                                                <i class="fas fa-inbox"></i> Nuevos
                                                <span class="badge bg-primary float-right">12</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" style="cursor: pointer;" wire:click="cambiarFiltroEstado('2')">
                                            <a  class="nav-link">
                                                <i class="far fa-envelope"></i> Atendidos
                                            </a>
                                        </li>
                                        <li class="nav-item" style="cursor: pointer;" wire:click="cambiarFiltroEstado('0')">
                                            <a  class="nav-link">
                                                <i class="far fa-trash-alt"></i> Archivados
                                            </a>
                                        </li>
                                        <li class="nav-item" style="cursor: pointer;" wire:click="cambiarFiltroEstado(null)">
                                            <a  class="nav-link">
                                                <i class="fa-solid fa-border-all"></i> Todos
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Nuevos</h3>

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            <input type="date" class="form-control" placeholder="Buscar por fecha">
                                            <div class="input-group-append">
                                                <div class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="mailbox-controls">
                                        <!-- Check all button -->
                                        {{--<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                                class="far fa-square"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-reply"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-share"></i>
                                            </button>
                                        </div>--}}
                                        <!-- /.btn-group -->
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <div class="float-right">
                                            1-50/200
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-sm">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.float-right -->
                                    </div>
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                @forelse ($reclamos as $key => $reclamo)
                                                <tr wire:click="edit({{ $reclamo->id }})" style="cursor: pointer;">
                                                    <td class="mailbox-name">{{ $reclamo->nombre_completo_consumidor }}</td>
                                                    <td class="mailbox-subject"><b>{{ $reclamo->descripcion_bien }}</b>
                                                    </td>
                                                    <td class="mailbox-subject">{{ $reclamo->descripcion_reclamacion_detalle }}
                                                    </td>
                                                    <td class="mailbox-date">{{ $reclamo->tiempoTranscurridoDesde($reclamo->created_at) }}</td>
                                                    @if ($this->filtroEstado == null)
                                                        <td class="mailbox-subject">{{ $reclamo->estado == '1' ? "Nuevo" : $reclamo->estado == '2' ? "Atendido" : "Archivado" }}</td>
                                                    @endif
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td @if ($this->filtroEstado == null) colspan="5" @else colspan="4" @endif class="text-center">
                                                        <h4>No hay registros</h4>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                    <!-- /.mail-box-messages -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer p-0">
                                    <div class="mailbox-controls">
                                        <!-- Check all button -->
                                        {{--<button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                            <i class="far fa-square"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-reply"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm">
                                                <i class="fas fa-share"></i>
                                            </button>
                                        </div>--}}
                                        <!-- /.btn-group -->
                                        <button type="button" class="btn btn-default btn-sm">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <div class="float-right">
                                            1-50/200
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-sm">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.float-right -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("livewire.libro-reclamacion.$vista")
</div>