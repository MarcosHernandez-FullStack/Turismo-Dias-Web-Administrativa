<div style="height: 100%!important;">
    <div class="small-box bg-blue" style="height: 100%!important;cursor: pointer;" wire:click="showModal">
        <div class="inner">
            <h3>General</h3>

            <p>Configura las características generales de la página web</p>
        </div>
        <div class="icon">
            <i class="fa-brands fa-slack"></i>
        </div>
        <a class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    <div class="modal fade @if ($verModal) show @endif" id="GeneralModal" tabindex="-1" role="dialog"
        aria-labelledby="GeneralModalTitle" aria-hidden="true"
        @if ($verModal) style="padding-right: 17px; display: block;" @endif>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form>
                <div class="modal-content">
                    <div class="modal-header bg-info text-light">
                        <h5 class="modal-title" id="GeneralModalTitle">General</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="razon_social">Razón Social</label>
                            <input type="text" wire:model='configuracion.razon_social'
                                class="form-control @error('configuracion.razon_social') is-invalid @enderror"
                                id="razon_social" placeholder="Ingresar Razón Social">
                            @error('configuracion.razon_social')
                                <span id="razon_social-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" wire:model='configuracion.nombre'
                                class="form-control @error('configuracion.nombre') is-invalid @enderror" id="nombre"
                                placeholder="Ingresar Nombre">
                            @error('configuracion.nombre')
                                <span id="nombre-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slogan">Eslogan</label>
                            <textarea wire:model='configuracion.slogan' class="form-control @error('configuracion.slogan') is-invalid @enderror"
                                id="slogan" rows="3" placeholder="Ingresar Eslogan"></textarea>
                            @error('configuracion.slogan')
                                <span id="slogan-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="horario_atencion_principal">Horario de Atención Principal</label>
                            <input type="text" wire:model='configuracion.horario_atencion_principal'
                                class="form-control @error('configuracion.horario_atencion_principal') is-invalid @enderror"
                                id="horario_atencion_principal" placeholder="Ingresar Horario de Atención Principal">
                            @error('configuracion.horario_atencion_principal')
                                <span id="horario_atencion_principal-error"
                                    class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times" aria-hidden="true"></i> Cerrar</button>
                        <button type="button" class="btn btn-sm rounded-pill btn-info" wire:loading.attr="disabled"
                            wire:target="save" wire:click="save"><i class="fas fa-save" aria-hidden="true"></i>
                            Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModalGeneral', event => {
            $("#GeneralModal").modal('hide');
        });
        window.addEventListener('showModalGeneral', event => {
            $("#GeneralModal").modal('show');
        });
    </script>
@endpush
