<div style="height: 100%!important;">
    <div class="small-box bg-warning" style="height: 100%!important;cursor: pointer;background-color:#FFCC1B!important;"
        wire:click="showModal">
        <div class="inner">
            <h3>Subtítulos</h3>

            <p>Establece los subtitulos de cada una de las vistas de tu página web</p>
        </div>
        <div class="icon">
            <i class="fa-solid fa-closed-captioning"></i>
        </div>
        <a class="small-box-footer">
            Ver más <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    <div class="modal fade @if ($verModal) show @endif" id="SubtitulosModal" tabindex="-1"
        role="dialog" aria-labelledby="SubtitulosModalTitle" aria-hidden="true"
        @if ($verModal) style="padding-right: 17px; display: block;" @endif>
        <form>
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-light">
                        <h5 class="modal-title" id="SubtitulosModalTitle">Subtítulos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="subtitulo_servicio">Subtítulo de Servicios</label>
                            <textarea wire:model='configuracion.subtitulo_servicio'
                                class="form-control @error('configuracion.subtitulo_servicio') is-invalid @enderror" id="subtitulo_servicio"></textarea>
                            @error('configuracion.subtitulo_servicio')
                                <span id="subtitulo_servicio-error"
                                    class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subtitulo_ruta">Subtítulo de Rutas</label>
                            <textarea wire:model='configuracion.subtitulo_ruta'
                                class="form-control @error('configuracion.subtitulo_ruta') is-invalid @enderror" id="subtitulo_ruta"></textarea>
                            @error('configuracion.subtitulo_ruta')
                                <span id="subtitulo_ruta-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subtitulo_termino_condicion">Subtítulo de Términos y Condiciones</label>
                            <textarea wire:model='configuracion.subtitulo_termino_condicion'
                                class="form-control @error('configuracion.subtitulo_termino_condicion') is-invalid @enderror"
                                id="subtitulo_termino_condicion"></textarea>
                            @error('configuracion.subtitulo_termino_condicion')
                                <span id="subtitulo_termino_condicion-error"
                                    class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subtitulo_evento">Subtítulo de Eventos</label>
                            <textarea wire:model='configuracion.subtitulo_evento'
                                class="form-control @error('configuracion.subtitulo_evento') is-invalid @enderror" id="subtitulo_evento"></textarea>
                            @error('configuracion.subtitulo_evento')
                                <span id="subtitulo_evento-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="subtitulo_libro_reclamacion">Subtítulo de Libro de Reclamaciones</label>
                            <textarea wire:model='configuracion.subtitulo_libro_reclamacion'
                                class="form-control @error('configuracion.subtitulo_libro_reclamacion') is-invalid @enderror"
                                id="subtitulo_libro_reclamacion" rows="4"></textarea>
                            @error('configuracion.subtitulo_libro_reclamacion')
                                <span id="subtitulo_libro_reclamacion-error"
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
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('closeModalSubtitulos', event => {
            $("#SubtitulosModal").modal('hide');
        });
        window.addEventListener('showModalSubtitulos', event => {
            $("#SubtitulosModal").modal('show');
        });
    </script>
@endpush
