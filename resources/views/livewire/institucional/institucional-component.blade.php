<div>
    <div class="row mb-2">
        <div class="col-12">
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
                    <div class="col-md-6">
                        <div class="row col-md-12 my-1 d-flex justify-content-between align-items-center">
                            <div class="row col-md-6">
                                <div class="border-info border-bottom text-info h1 font-weight-bolder"
                                    style="border-bottom-width:5px !important">Intitucional</div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-12 row">
                                <div class="form-group col-md-12">
                                    <label for="slogan_home" class="form-label">
                                        Slogan home
                                    </label>
                                    <input type="text" class="form-control form-control-sm rounded-pill" id="slogan_home"
                                        wire:model='institucional.slogan_home'>
                                    @error('institucional.slogan_home')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="breve_historia" class="form-label">
                                        Breve historia
                                    </label>
                                    <textarea type="text" class="form-control form-control-sm rounded-lg" id="breve_historia"
                                        wire:model='institucional.breve_historia'>
                                    </textarea>
                                    @error('institucional.breve_historia')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mision" class="form-label">
                                        Mision
                                    </label>
                                    <textarea type="text" class="form-control form-control-sm rounded-lg" id="mision"
                                        wire:model='institucional.mision'>
                                    </textarea>
                                    @error('institucional.mision')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="vision" class="form-label">
                                        Vision
                                    </label>
                                    <textarea type="text" class="form-control form-control-sm rounded-lg" id="vision"
                                        wire:model='institucional.vision'>
                                    </textarea>
                                    @error('institucional.vision')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto" class="form-label text-capitalize">
                                        Foto principal
                                    </label>
                                    <input type="file" class="form-control form-control-sm rounded-pill"
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
                                                class="img-thumbnail w-100" alt="foto">
                                        </div>
                                    @endif
                                    @if ($institucional->ruta_foto_principal && !$ruta_foto_principal)
                                        <div class="form-group col-md-12">
                                            <label class="form-label text-capitalize">
                                                Foto Principal Registrada
                                            </label>
                                            <img src="{{ Storage::url($institucional->ruta_foto_principal) }}"
                                                class="img-thumbnail w-100" alt="foto_guardada">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto" class="form-label text-capitalize">
                                        Foto secundaria
                                    </label>
                                    <input type="file" class="form-control form-control-sm rounded-pill"
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
                                                class="img-thumbnail w-100" alt="foto">
                                        </div>
                                    @endif
                                    @if ($institucional->ruta_foto_secundaria && !$ruta_foto_secundaria)
                                        <div class="form-group col-md-12">
                                            <label class="form-label text-capitalize">
                                                Foto Secundaria Registrada
                                            </label>
                                            <img src="{{ Storage::url($institucional->ruta_foto_secundaria) }}"
                                                class="img-thumbnail w-100" alt="foto_guardada">
                                        </div>
                                    @endif
                                </div>
    
    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="row col-md-12 my-1 d-flex justify-content-between align-items-center">
                            <div class="row col-md-6 col-md-6">
                                <div class="border-info border-bottom text-info h1 font-weight-bolder"
                                    style="border-bottom-width:5px !important">Valores</div>
                            </div>
                            <div class="row col-md-6 col-md-2 justify-content-end">
                                <button type="button" class="btn btn-info btn-sm rounded-pill" wire:click="addValorCollection">
                                    <i class="fas fa-plus"></i>
                                    Añadir Valor
                                </button>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-12 row">
                                <div class="form-group col-md-12">
                                    <label for="descripcion" class="form-label">
                                        Valor
                                    </label>
                                    <input type="text" class="form-control form-control-sm rounded-pill" id="descripcion"
                                        wire:model='descripcion'>
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
                                                <th style="width:100px" rowspan="1" colspan="1">Descripcion</th>
                                                <th style="width:50px" rowspan="1" colspan="1">Estado</th>
                                                <th style="width:100px" rowspan="1" colspan="1">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($valores_collection as $key => $valor)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $valor->descripcion }}</td>
                                                    <td><span role="button"
                                                            class="badge rounded-pill bg-{{ $valor->estado == '1' ? 'success' : 'warning' }}"
                                                            wire:click='cambiarEstado({{ $valor->id }})'>{{ $valor->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger btn-sm rounded-pill"
                                                            data-toggle="modal" data-target="#modal_usuario"
                                                            wire:click="deleteValorCollection({{ $key  }})"><i
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
                    <div class="row col-md-12 col-md-2 justify-content-end">
                        @if ($institucional->id)
                        <button role="button"
                        class="btn rounded-pill btn-sm {{ $institucional->estado ? 'bg-success' : 'bg-warning' }}"
                        wire:click='cambiarEstado({{ $institucional->id }})'>{{ $institucional->estado ? 'ACTIVO' : 'INACTIVO' }}
                        </button>
                        @endif
                        <button type="button" class="btn btn-warning btn-sm rounded-pill" wire:click="update">
                            <i class="fas fa-edit"></i>
                            Guardar Todo
                        </button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
