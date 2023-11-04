<div style="height: 100%!important;">
    <div class="small-box bg-green" style="height: 100%!important;cursor: pointer;" wire:click="showModal">
        <div class="inner">
            <h3>Contacto</h3>

            <p>Maneja redes, correos y números de contacto</p>
        </div>
        <div class="icon">
            <i class="fa-solid fa-address-card"></i>
        </div>
        <a class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>

    <div class="modal fade @if($verModal)show @endif" id="ContactoModal" tabindex="-1" role="dialog"
        aria-labelledby="ContactoModalTitle" aria-hidden="true" @if($verModal)
        style="padding-right: 17px; display: block;" @endif>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h5 class="modal-title" id="ContactoModalTitle">Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-info">
                        <div class="card-header bg-lime">
                            <h3 class="card-title">Correo y Números Telefónicos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="celular_principal">Telefóno/Celular Principal</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-solid fa-phone fa-shake"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.celular_principal'
                                                class="form-control @error('configuracion.celular_principal') is-invalid @enderror"
                                                id="celular_principal" placeholder="Ingrese un Telefóno/Celular">
                                            @error('configuracion.celular_principal')
                                            <span id="celular_principal-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="celular_secundario">Telefóno/Celular Secundario</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-solid fa-mobile-screen-button fa-shake"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.celular_secundario'
                                                class="form-control @error('configuracion.celular_secundario') is-invalid @enderror"
                                                id="celular_secundario" placeholder="Ingrese un Telefóno/Celular">
                                            @error('configuracion.celular_secundario')
                                            <span id="celular_secundario-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="correo_principal">Correo Principal</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" wire:model='configuracion.correo_principal'
                                                class="form-control @error('configuracion.correo_principal') is-invalid @enderror"
                                                id="correo_principal" placeholder="Ingrese un correo">
                                            @error('configuracion.correo_principal')
                                            <span id="correo_principal-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="correo_secundario">Correo Secundario</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" wire:model='configuracion.correo_secundario'
                                                class="form-control @error('configuracion.correo_secundario') is-invalid @enderror"
                                                id="correo_secundario" placeholder="Ingrese un correo">
                                            @error('configuracion.correo_secundario')
                                            <span id="correo_secundario-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header bg-maroon">
                            <h3 class="card-title">Redes Sociales</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="link_facebook">Facebook</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-brands fa-facebook"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.link_facebook'
                                                class="form-control @error('configuracion.link_facebook') is-invalid @enderror"
                                                id="link_facebook" placeholder="Ingrese URL de Facebook">
                                            @error('configuracion.link_facebook')
                                            <span id="link_facebook-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="link_instagram">Instagram</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-brands fa-instagram"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.link_instagram'
                                                class="form-control @error('configuracion.link_instagram') is-invalid @enderror"
                                                id="link_instagram" placeholder="Ingrese URL de Instagram">
                                            @error('configuracion.link_instagram')
                                            <span id="link_instagram-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="link_youtube">Youtube</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-brands fa-youtube"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.link_youtube'
                                                class="form-control @error('configuracion.link_youtube') is-invalid @enderror"
                                                id="link_youtube" placeholder="Ingrese URL de Youtube">
                                            @error('configuracion.link_youtube')
                                            <span id="link_youtube-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="link_linkedln">LinkedIn</label>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa-brands fa-linkedin"></i></span>
                                            </div>
                                            <input type="text" wire:model='configuracion.link_linkedln'
                                                class="form-control @error('configuracion.link_linkedln') is-invalid @enderror"
                                                id="link_linkedln" placeholder="Ingrese URL de LinkedIn">
                                            @error('configuracion.link_linkedln')
                                            <span id="link_linkedln-error" class="error invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i> Cerrar</button>
                    <button type="button" class="btn btn-sm rounded-pill btn-info" wire:click="save"><i class="fas fa-save" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('closeModalContacto', event => {
            $("#ContactoModal").modal('hide');
        });
    window.addEventListener('showModalContacto', event => {
        $("#ContactoModal").modal('show');
    });
</script>
@endpush