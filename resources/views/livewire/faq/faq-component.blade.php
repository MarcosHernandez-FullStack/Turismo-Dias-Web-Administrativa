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
                                        <b style="color: rgb(48, 48, 48)">PREGUNTAS Y RESPUESTAS</b></h5>

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
                            'label' => '',
                            'create_function' => "showModal('form', 'create')",
                            'condition_message' => session()->has('message'),
                            'find' => 'Buscar por campos del faq',
                        ])
                        <div class="row my-1">

                            <div class="col-sm-12">
                                <table id="example1" class="table table-sm m-0 rounded-pill"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th style="width:20px" rowspan="1" colspan="1">#</th>
                                            <th style="width:250px" rowspan="1" colspan="1">Pregunta</th>
                                            <th style="width:300px" rowspan="1" colspan="1">Respuesta</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Tipo</th>
                                            <th style="width:50px" rowspan="1" colspan="1">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($faqs as $key => $faq)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $faq->pregunta }}</td>
                                                <td>{{ $faq->respuesta }}</td>
                                                <td>
                                                    @if ($faq->tipo == '1') Principal @endif
                                                    @if ($faq->tipo == '2') Secundaria @endif
                                                 </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                        data-toggle="modal" data-target="#modal_usuario"
                                                        wire:click="edit({{ $faq->id }})"><i
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
                        @include('layouts.footer-listado', ['elementosListado' => $faqs])
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @include("livewire.faq.$vista")
</div>
