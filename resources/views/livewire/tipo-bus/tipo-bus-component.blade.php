<div>
    <div id="accordionTipoBus">
        <div class="card card-info">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTipoBus">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-van-shuttle"></i> Tipos de Bus
                            </div>
                            <i class="fa-solid fa-arrows-up-down fa-bounce"></i>
                        </div>
                    </a>
                </h4>
            </div>
            <div wire:ignore.self id="collapseTipoBus" class="collapse" data-parent="#accordionTipoBus">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-info btn-sm rounded-pill"
                                    wire:click="showModal('form', 'create')">
                                    <i class="fas fa-plus"></i>
                                    Nuevo Tipo de Bus
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                @forelse ($tipobuses as $key => $tipoBus)
                                    <div class="col-12 col-lg-4 mx-auto mb-3">
                                        <div style="height: 100%!important;">
                                            <div class="small-box text-light"
                                                style="height: 100%!important;cursor: pointer;background-color: rgb(9, 63, 68);!important;"
                                                wire:click="edit({{ $tipoBus->id }})">
                                                <div class="inner">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <h3>{{ $tipoBus->nombre }}</h3>

                                                            <p>{{ $tipoBus->descripcion }}</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 d-flex align-items-center">
                                                            @if (isset($tipoBus->ruta_foto))
                                                                <img style="height: 120px; max-width: 100%;"
                                                                    src="{{ Storage::url($tipoBus->ruta_foto) }}"
                                                                    alt="...">
                                                            @else
                                                                <img style="height: 120px; max-width: 100%;"
                                                                    src="{{ asset('assets/img/1280x720.png') }}"
                                                                    alt="...">
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="small-box-footer">
                                                    Editar <i class="fa-solid fa-pen"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTipoBus" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                @include('livewire.tipo-bus.form')
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModalTipoBus', event => {
            $("#modalTipoBus").modal('hide');
        });
        window.addEventListener('showModalTipoBus', event => {
            $("#modalTipoBus").modal('show');
        });
    </script>
@endpush
