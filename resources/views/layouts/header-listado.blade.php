                        @if ($condition_message)
                            <div class="row col-12 alert alert-success alert-dismissible fade show" role="alert">
                                <div>
                                    {{ session('message') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row my-1">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group d-flex align-items-center">
                                    <label class="m-0">Buscar</label><input type="search"
                                        class="form-control form-control-sm ml-1 rounded-pill"
                                        placeholder="{{ $find }}" wire:model="search" aria-controls="example1">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="form-group d-flex justify-content-end">
                                    <button type="button" class="btn btn-info btn-sm rounded-pill" data-toggle="modal"
                                    data-target="#modal_usuario" wire:click="{{ $create_function }}">
                                    <i class="fas fa-plus"></i>
                                    Nuevo {{ $label }}
                                </button>
                                </div>
                            </div>

                        </div>
