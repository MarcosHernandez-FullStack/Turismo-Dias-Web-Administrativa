<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 card  m-0 bg-info">
                <div class="card-header p-1 ">
                    <p class="card-title">Distritos @if ($this->ciudad)
                            de {{ $this->ciudad->descripcion }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="row mt-1 align-items-center">
            <div class="col-12 {{ $this->form == 'update' ? 'col-md-8' : 'col-md-8' }}">
                <div class="form-group ">
                    <label for="descripcion" class="m-0">{{ $this->form == 'update' ? 'Editar' : 'Registrar' }}
                        Distrito</label>
                    <input type="text"
                        class="form-control form-control-sm ml-1 rounded-pill @error('subCiudad.descripcion') is-invalid @enderror"
                        placeholder="Ingresar descripción" wire:model="subCiudad.descripcion"
                        @if (!isset($this->ciudad)) disabled @endif id="descripcion" aria-controls="example1">
                    @error('subCiudad.descripcion')
                        <span id="descripcion-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div
                class="col-12 {{ $this->form == 'update' ? 'col-md-4' : 'col-md-4' }}   justify-content-end  align-items-center">
                <div class="form-group row mb-0">
                    <div class="col-12 {{ $this->form == 'update' ? 'col-md' : '' }} ">
                        <button type="button"
                            class="btn btn-{{ $this->form == 'update' ? 'success' : 'info' }} btn-sm rounded-pill"
                            wire:loading.attr="disabled" wire:target="save" wire:click="save"
                            @if (!isset($this->ciudad)) disabled @endif>
                            @if ($this->form == 'update')
                                <i class="fa-regular fa-floppy-disk"></i>
                            @else
                                <i class="fas fa-plus"></i>
                            @endif
                            {{ $this->form == 'update' ? 'Guardar' : 'Añadir Distrito' }}
                        </button>
                    </div>
                    @if ($this->form == 'update')
                        <div class="col-12 col-md ">
                            <button type="button" class="btn btn-danger btn-sm rounded-pill" wire:click="cancelar()"
                                @if (!isset($this->ciudad)) disabled @endif>
                                <i class="fa-solid fa-xmark"></i>
                                Cancelar
                            </button>
                        </div>
                    @endif

                </div>


            </div>
        </div>
        <div class="row  my-1 justify-content-center">
            <div class="col-sm-12">
                <div class="card  m-0">

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 213px;">
                        <table class="table table-head-fixed table-sm m-0 ">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th>Descripción</th>
                                    <th style="width:100px">Estado</th>
                                    <th style="width:100px">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($this->ciudad)
                                    @forelse ($subciudades as $key =>$subciudad)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subciudad->descripcion }}</td>
                                            <td><span role="button"
                                                    class="badge rounded-pill bg-{{ $subciudad->estado == '1' ? 'success' : 'warning' }}"
                                                    wire:click='cambiarEstado({{ $subciudad->id }})'>{{ $subciudad->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span>
                                            </td>
                                            <td><button type="button"
                                                    class="btn btn-sm btn-warning btn-sm rounded-pill"
                                                    wire:click="edit({{ $subciudad->id }})"><i class="fas fa-pen"></i>
                                                </button></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay registros</td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Seleccione una Ciudad!!!</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</div>
