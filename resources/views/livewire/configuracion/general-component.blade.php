<div style="height: 100%!important;">
    <div class="small-box bg-blue" style="height: 100%!important;cursor: pointer;" data-toggle="modal"
        data-target="#GeneralModal">
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
    <div class="modal fade" id="GeneralModal" tabindex="-1" role="dialog" aria-labelledby="GeneralModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GeneralModalTitle">General</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="razonSocial">Razón Social</label>
                        <input type="text" class="form-control" id="razonSocial" placeholder="Ingresar Razón Social">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingresar Nombre">
                    </div>
                    <div class="form-group">
                        <label for="slogan">Eslogan</label>
                        <textarea class="form-control" id="slogan" rows="3" placeholder="Ingresar Eslogan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="horarioAtencionPrincipal">Horario de Atención Principal</label>
                        <input type="text" class="form-control" id="horarioAtencionPrincipal" placeholder="Ingresar Horario de Atención Principal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>