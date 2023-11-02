<div style="height: 100%!important;">
  <div class="small-box bg-danger" style="height: 100%!important;cursor: pointer;" wire:click="showModal">
    <div class=" inner">
      <h3>Multimedia</h3>

      <p>Edita las imágenes y video que se mostrarán en la página web</p>
    </div>
    <div class="icon">
      <i class="fa-regular fa-images"></i>
    </div>
    <a class="small-box-footer">
      Ver más <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
  <div class="modal fade @if($verModal)show @endif" id="ImagenesModal" tabindex="-1" role="dialog"
    aria-labelledby="ImagenesModalTitle" aria-hidden="true" @if($verModal) style="padding-right: 17px; display: block;"
    @endif>
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ImagenesModalTitle">Multimedia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1 bg-danger">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link @if ($tab=='ruta_foto_principal_tab') active @endif" id="ruta_foto_principal_tab"
                    data-toggle="pill" href="#ruta_foto_principal_tabContent" role="tab"
                    aria-controls="ruta_foto_principal_tabContent" aria-selected="true">Principal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  @if ($tab=='ruta_video_tab') active @endif" id="ruta_video_tab" data-toggle="pill"
                    href="#ruta_video_tabContent" role="tab" aria-controls="ruta_video_tabContent"
                    aria-selected="false">Video</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  @if ($tab=='ruta_foto_header_seccion_tab') active @endif"
                    id="ruta_foto_header_seccion_tab" data-toggle="pill" href="#ruta_foto_header_seccion_tabContent"
                    role="tab" aria-controls="ruta_foto_header_seccion_tabContent" aria-selected="false">Encabezado</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade @if ($tab=='ruta_foto_principal_tab') active show @endif"
                  id="ruta_foto_principal_tabContent" role="tabpanel"
                  aria-labelledby="ruta_foto_principal_tabContent-tab">
                  <div class="form-group">
                    <label>Imagen de Página Principal</label>
                    <div wire:ignore x-data x-init="
                    FilePond.create($refs.input_ruta_foto_principal,{
                            labelIdle: 'Arrastra y suelta tus archivos, o <span class=\'filepond--label-action\'> Busca </span>',
                            credits : {},
                            allowMultiple: false,
                            acceptedFileTypes: ['image/*'],
                            checkValidity:true,
                            labelFileLoading:'Cargando',
                            labelFileLoadError:'Error durante la carga',
                            labelFileProcessing:'Subiendo',
                            labelFileProcessingComplete :'Completado',
                            labelFileProcessingAborted:'Cancelado',
                            //VALIDACION DE TAMAÑO
                            maxFileSize: '1MB',
                            labelMaxFileSizeExceeded: 'El archivo es muy grande',
                            labelMaxFileSize:'El tamaño máximo permitido es de {filesize}',
                            server:{
                              process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                                @this.upload('ruta_foto_principal',file,load,error,progress)
                              },
                              revert: (filename, load) => {
                                @this.removeUpload('ruta_foto_principal',filename,load)
      
                              },
                            },
                            onaddfile:(error,file)=>{
                              @this.cambiarTab('ruta_foto_principal_tab');
                            },
                          });">
                      <input wire:model='ruta_foto_principal' type="file" x-ref="input_ruta_foto_principal"
                        name="ruta_foto_principal">

                    </div>
                    @error('ruta_foto_principal')
                    <span class="error invalid-feedback" style="display: block;">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="contenedor-imagen">
                        @if (isset($ruta_foto_principal))
                        <img src="{{ $ruta_foto_principal->temporaryUrl() }}" alt="...">
                        @else
                        <img src="{{ Storage::disk('configuracion')->url($configuracion->ruta_foto_principal) }}"
                          alt="...">
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
                <div class="tab-pane fade @if ($tab=='ruta_video_tab') active show @endif" id="ruta_video_tabContent"
                  role="tabpanel" aria-labelledby="ruta_video_tabContent-tab">
                  <div class="form-group">
                    <label>Video de bienvenida</label>
                    <div wire:ignore x-data x-init="
                    FilePond.create($refs.input_ruta_video,{
                            labelIdle: 'Arrastra y suelta tus archivos, o <span class=\'filepond--label-action\'> Busca </span>',
                            credits : {},
                            allowMultiple: false,
                            acceptedFileTypes: ['video/*'],
                            checkValidity:true,
                            labelFileLoading:'Cargando',
                            labelFileLoadError:'Error durante la carga',
                            labelFileProcessing:'Subiendo',
                            labelFileProcessingComplete :'Completado',
                            labelFileProcessingAborted:'Cancelado',
                            //VALIDACION DE TAMAÑO
                            maxFileSize: '100MB',
                            labelMaxFileSizeExceeded: 'El archivo es muy grande',
                            labelMaxFileSize:'El tamaño máximo permitido es de {filesize}',
                            server:{
                              process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                                @this.upload('ruta_video',file,load,error,progress)
                              },
                              revert: (filename, load) => {
                                @this.removeUpload('ruta_video',filename,load)
      
                              },
                            },
                            onaddfile:(error,file)=>{
                              @this.cambiarTab('ruta_video_tab');
                            },
                          });">
                      <input wire:model='ruta_video' type="file" x-ref="input_ruta_video"
                        name="ruta_video">

                    </div>
                    @error('ruta_video')
                    <span class="error invalid-feedback" style="display: block;">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="contenedor-imagen">
                        @if (isset($ruta_video))
                          <video width="640" height="360" controls>
                            <source src="{{ $ruta_video->temporaryUrl() }}">
                            Tu navegador no soporta la reproducción de videos.
                        </video>
                        <img src="" alt="...">
                        @elseif (isset($configuracion->ruta_video))
                        <video width="640" height="360" controls>
                          <source src="{{ Storage::disk('configuracion')->url($configuracion->ruta_video)  }}">
                          Tu navegador no soporta la reproducción de videos.
                      </video>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade @if ($tab=='ruta_foto_header_seccion_tab') active show @endif"
                  id="ruta_foto_header_seccion_tabContent" role="tabpanel"
                  aria-labelledby="ruta_foto_header_seccion_tabContent-tab">
                  <div class="form-group">
                    <label>Imagen de los Encabezados</label>
                    <div wire:ignore x-data x-init="
                    FilePond.create($refs.input_ruta_foto_header_seccion,{
                            labelIdle: 'Arrastra y suelta tus archivos, o <span class=\'filepond--label-action\'> Busca </span>',
                            credits : {},
                            allowMultiple: false,
                            acceptedFileTypes: ['image/*'],
                            checkValidity:true,
                            labelFileLoading:'Cargando',
                            labelFileLoadError:'Error durante la carga',
                            labelFileProcessing:'Subiendo',
                            labelFileProcessingComplete :'Completado',
                            labelFileProcessingAborted:'Cancelado',
                            //VALIDACION DE TAMAÑO
                            maxFileSize: '1MB',
                            labelMaxFileSizeExceeded: 'El archivo es muy grande',
                            labelMaxFileSize:'El tamaño máximo permitido es de {filesize}',
                            server:{
                              process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
                                @this.upload('ruta_foto_header_seccion',file,load,error,progress)
                              },
                              revert: (filename, load) => {
                                @this.removeUpload('ruta_foto_header_seccion',filename,load)
      
                              },
                            },
                            onaddfile:(error,file)=>{
                              @this.cambiarTab('ruta_foto_header_seccion_tab');
                            },
                          });">
                      <input wire:model='ruta_foto_header_seccion' type="file" x-ref="input_ruta_foto_header_seccion"
                        name="ruta_foto_header_seccion">

                    </div>
                    @error('ruta_foto_header_seccion')
                    <span class="error invalid-feedback" style="display: block;">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="contenedor-imagen">
                        @if (isset($ruta_foto_header_seccion))
                        <img src="{{ $ruta_foto_header_seccion->temporaryUrl() }}" alt="...">
                        @elseif (isset($configuracion->ruta_foto_header_seccion))
                        <img src="{{ Storage::disk('configuracion')->url($configuracion->ruta_foto_header_seccion)  }}"
                          alt="...">
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
  window.addEventListener('closeModalImagenes', event => {
            $("#ImagenesModal").modal('hide');
        });
    window.addEventListener('showModalImagenes', event => {
        $("#ImagenesModal").modal('show');
    });
    

</script>
@endpush