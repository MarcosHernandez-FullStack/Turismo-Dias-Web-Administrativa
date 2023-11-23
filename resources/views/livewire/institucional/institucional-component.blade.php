<div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card card-default color-palette-box">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{--  <h1 class="card-title">Configuración de Página Web</h1> --}}
                                    <h5><i style="color: #17a2b8"
                                        class="fa-solid fa-house  mr-1"></i>
                                        <b style="color: rgb(48, 48, 48)">INSTITUCIONAL (NOSOTROS Y NUESTROS VALORES)</b></h5>

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
                <div class="card-body p-3 row">
                    @if (session()->has('message'))
                        <div class="row col-12 alert alert-success alert-dismissible fade show" role="alert">
                            <div>
                                {{ session('message') }}
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="@if($institucional->id) col-md-6 @else col-md-12 @endif">
                        {{-- <div class="row col-md-12 my-1 d-flex justify-content-between align-items-center">
                            <div class="row col-md-6">
                                <div class="border-info border-bottom text-info h1 font-weight-bolder"
                                    style="border-bottom-width:5px !important">Nosotros</div>

                            </div>
                        </div> --}}
                        <div class="row col-md-12">
                            <div class="col-md-12 row">
                                <div class="form-group col-md-9">
                                    <label for="slogan_home" class="form-label">
                                        Eslogan (Acerca de Nosotros)
                                    </label>
                                    <input type="text" class="form-control form-control-sm rounded-pill"
                                        id="slogan_home" wire:model='institucional.slogan_home'>
                                    @error('institucional.slogan_home')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fecha_inicio" class="form-label">
                                        Fecha de inicio
                                    </label>
                                    <input type="date" class="form-control form-control-sm rounded-pill"
                                        id="fecha_inicio" wire:model='institucional.fecha_inicio'>
                                    @error('institucional.fecha_inicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="breve_historia" class="form-label">
                                        Breve historia
                                    </label>
                                    <textarea type="text" rows="4" class="form-control form-control-sm rounded-lg" id="breve_historia"
                                        wire:model='institucional.breve_historia'>
                                    </textarea>
                                    @error('institucional.breve_historia')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mision" class="form-label">
                                        Misión
                                    </label>
                                    <textarea type="text" rows="8" class="form-control form-control-sm rounded-lg" id="mision"
                                        wire:model='institucional.mision'>
                                    </textarea>
                                    @error('institucional.mision')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="vision" class="form-label">
                                        Visión
                                    </label>
                                    <textarea type="text" rows="8" class="form-control form-control-sm rounded-lg" id="vision"
                                        wire:model='institucional.vision'>
                                    </textarea>
                                    @error('institucional.vision')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto" class="form-label text-capitalize">
                                       Imagen (Sección Inicio)
                                    </label>
                                    <input accept="image/*" type="file" onchange="validarImagen(this)" class="form-control form-control-sm rounded-pill"
                                        id="ruta_foto_principal" wire:model='ruta_foto_principal'>
                                    @error('ruta_foto_principal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($ruta_foto_principal)
                                        <div class="form-group col-md-12">
                                            {{-- titulo de foto --}}
                                            <label class="form-label text-capitalize">
                                                Foto Principal Nueva
                                            </label>
                                            <img src="{{ $ruta_foto_principal->temporaryUrl() }}"
                                                class="img-thumbnail w-100" style="height:450px;object-fit:cover" alt="foto">
                                        </div>
                                    @endif
                                    @if ($institucional->ruta_foto_principal && !$ruta_foto_principal)
                                        <div class="form-group col-md-12">
                                            <label class="form-label text-capitalize">
                                                Imagen Registrada
                                            </label>
                                            <img src="{{ Storage::url($institucional->ruta_foto_principal) }}"
                                                class="img-thumbnail w-100" style="height:450px;object-fit:cover" alt="foto_guardada">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto" class="form-label text-capitalize">
                                        Imagen (Sección Nosotros)
                                    </label>
                                    <input accept="image/*" type="file" onchange="validarImagen(this)" class="form-control form-control-sm rounded-pill"
                                        id="ruta_foto_secundaria" wire:model='ruta_foto_secundaria'>
                                    @error('ruta_foto_secundaria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($ruta_foto_secundaria)
                                        <div class="form-group col-md-12">
                                            {{-- titulo de foto --}}
                                            <label class="form-label text-capitalize">
                                                Foto Secundaria Nueva
                                            </label>
                                            <img src="{{ $ruta_foto_secundaria->temporaryUrl() }}"
                                                class="img-thumbnail w-100" style="height:450px;object-fit:cover" alt="foto">
                                        </div>
                                    @endif
                                    @if ($institucional->ruta_foto_secundaria && !$ruta_foto_secundaria)
                                        <div class="form-group col-md-12">
                                            <label class="form-label text-capitalize">
                                                Imagen Registrada
                                            </label>
                                            <img src="{{ Storage::url($institucional->ruta_foto_secundaria) }}"
                                                class="img-thumbnail w-100" style="height:450px;object-fit:cover" alt="foto_guardada">
                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                        <div class="row col-md-12 col-md-2 mb-5 mb-md-0">
                            <button type="button" class="btn btn-info btn-sm rounded-pill" wire:loading.attr="disabled" wire:target="update,ruta_foto_principal,ruta_foto_secundaria"
                             wire:click="update">
                                <i class="fas fa-edit"></i>
                                Guardar
                            </button>
                        </div>
                    </div>
                    @if($institucional->id)
                    <div class="col-md-6">
                        <div class="row col-md-12">
                            <div class="row col-md-12">
                                <div class="form-inline col-md-12">
                                    <div class="form-group flex-grow-1">
                                        <label for="descripcion" class="form-label">
                                            Valor
                                        </label>
                                        <input type="text" class="flex-grow-1 form-control form-control-sm rounded-pill mx-2"
                                            id="descripcion" wire:model='descripcion'>
                                    </div>
                                    <button type="button" class="form-control form-control-sm btn btn-info btn-sm rounded-pill"
                                    wire:click="addValorCollection">
                                        <i class="fas fa-plus"></i>
                                        Añadir Valor
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    @error('descripcion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12">
                                    <label for="descripcion" class="form-label">
                                        Listado de Valores
                                    </label>
                                    <table id="example1" class="table table-sm m-0 rounded-pill"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th style="width:20px" rowspan="1" colspan="1">#</th>
                                                <th style="width:100px" rowspan="1" colspan="1">Descripcion
                                                </th>
                                                <th style="width:50px" rowspan="1" colspan="1">Estado</th>
                                                <th style="width:100px" rowspan="1" colspan="1">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($valores_collection as $key => $valor)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $valor->descripcion }}</td>
                                                    <td>
                                                        @if ($valor->id)
                                                            
                                                        <span role="button"
                                                        class="badge rounded-pill bg-{{ $valor->estado == '1' ? 'success' : 'warning' }}"
                                                        wire:click='cambiarEstado({{ $valor->id }})'>{{ $valor->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                        @else
                                                        pendiente
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger btn-sm rounded-pill"
                                                            data-toggle="modal" data-target="#modal_usuario"
                                                            wire:click="confirmardeleteValorCollection({{ $valor->id }})"><i
                                                                class="fas fa-trash"></i>
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
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
