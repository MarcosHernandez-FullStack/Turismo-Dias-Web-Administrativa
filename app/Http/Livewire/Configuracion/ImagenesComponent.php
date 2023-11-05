<?php

namespace App\Http\Livewire\Configuracion;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;


class ImagenesComponent extends Component
{
    use WithFileUploads;
    public $ruta_foto_principal,$ruta_video,$ruta_foto_header_seccion;
    public $configuracion;
    public $configuracionOriginal;
    //VARIABLE PARA VERIFICAR SI EL MODAL ESTA ABIERTO O CERRADO
    //DEBIDO A QUE LA VALIDACION  RENDERIZA DE NUEVO EL COMPONENTE, SE CIERRA AUTOMATICAMENTE
    public $verModal=false; 
    public $tab='ruta_foto_principal_tab';

    //DEFINICION DE REGLAS DE VALIDACION
    //LA VALIDACIOND E LAS IMAGENES SE HACE CON FILEPOND
    protected $rules = [
        //'ruta_foto_principal' => 'image|max:1024',
        'configuracion.ruta_video' => 'url|max:255',
        //'ruta_foto_header_seccion' => 'image|max:1024',
    ];

   protected $messages = [
        //'ruta_foto_principal.image' => 'El archivo debe ser de tipo imagen.',
        'configuracion.ruta_video.url' => 'El texto debe ser una URL.',
        //'ruta_foto_header_seccion.image' => 'El archivo debe ser de tipo imagen.',
        //'ruta_foto_principal.max:1024' => 'El tamaño máximo del archivo debe ser de 1MB.',
        'configuracion.ruta_video.max:255' => 'El tamaño máximo de la URL es de 255 caracteres.',
        //'ruta_foto_header_seccion.max:1024' => 'El tamaño máximo del archivo debe ser de 1MB.',
    ];
    
    //SE VERIFICA SI EXISTE LA CONFIGURACON, DE LO CONTRARIO CREA UNA 
    public function mount(){
        $this->configuracion=Configuracion::first();
        if(!isset($this->configuracion)){
            $this->configuracion=new Configuracion();
        }
        $this->configuracionOriginal=$this->configuracion;
    }

    public function render()
    {
        return view('livewire.configuracion.imagenes-component');
    }

    //FUNCION PARA MOSTRAR ERRORES DE VALIDACION EN TIEMPO REAL
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    //FUNCION PARA RESETEAR VARIABLES Y ERRORES DE VALIDACION
    public function resetError(){
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //FUNCION PARA RESETEAR VALORES DE MI VARIABLE
    //EVITA ESTAR CONSULTANDO CONTINUAMENTE AL ABRIR EL MODAL
    public function resetValues(){
        $this->configuracion=$this->configuracionOriginal;
    }

    public function showModal(){
        $this->resetError();
        $this->resetValues();
        $this->verModal=true;
        $this->dispatchBrowserEvent('showModalImagenes');
    }

    public function closeModal(){
        $this->verModal=false;
        $this->dispatchBrowserEvent('closeModalImagenes');
    }

    public function cambiarTab($tab){
        $this->tab=$tab;
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
        if($this->ruta_foto_principal){
            if($this->ruta_foto_principal!=$this->configuracion->ruta_foto_principal) {
                if (Storage::disk('configuracion')->exists($this->configuracion->ruta_foto_principal)) {
                    Storage::disk('configuracion')->delete($this->configuracion->ruta_foto_principal);
                }
                $this->configuracion->ruta_foto_principal = $this->ruta_foto_principal->store('/','configuracion');
            }
        }
        if($this->ruta_video){
            if($this->ruta_video!=$this->configuracion->ruta_video) {
                if (Storage::disk('configuracion')->exists($this->configuracion->ruta_video)) {
                    Storage::disk('configuracion')->delete($this->configuracion->ruta_video);
                }
                $this->configuracion->ruta_video = $this->ruta_video->store('/','configuracion');
            }
            
        }
        if($this->ruta_foto_header_seccion){
            if($this->ruta_foto_header_seccion!=$this->configuracion->ruta_foto_header_seccion) {
                if (Storage::disk('configuracion')->exists($this->configuracion->ruta_foto_header_seccion)) {
                    Storage::disk('configuracion')->delete($this->configuracion->ruta_foto_header_seccion);
                }
                $this->configuracion->ruta_foto_header_seccion = $this->ruta_foto_header_seccion->store('/','configuracion');
            }
        }
        if ($this->configuracion==$this->configuracionOriginal){
            $this->closeModal();
            $this->cambiarTab('ruta_foto_principal_tab');
            $this->dispatchBrowserEvent('info',['mensaje' => 'El registro no ha sufrido cambios!']);
        }else{
            $this->configuracion->save();
            $this->closeModal();
            $this->cambiarTab('ruta_foto_principal_tab');
            $this->configuracion=Configuracion::first(); //CONSULTA LOS VALORES GUARDADOS EN BD
            $this->configuracionOriginal=$this->configuracion; //LE ASIGAN AL AUXILIAR DE ORIGINAL PARA UNA POSTERIOR EDICIÓN
            $this->dispatchBrowserEvent('success',['mensaje' => 'El registro se ha guardado correctamente!']);
        }
        
    }
}
