<?php

namespace App\Http\Livewire\Configuracion;

use Livewire\Component;
use App\Models\Configuracion;

class ContactoComponent extends Component
{
    public $configuracion;
    public $configuracionOriginal;
    //VARIABLE PARA VERIFICAR SI EL MODAL ESTA ABIERTO O CERRADO
    //DEBIDO A QUE LA VALIDACION  RENDERIZA DE NUEVO EL COMPONENTE, SE CIERRA AUTOMATICAMENTE
    public $verModal=false;

    //DEFINICION DE REGLAS DE VALIDACION
    protected $rules = [
        'configuracion.celular_principal' => 'required|max:9',
        'configuracion.correo_principal' => 'required|max:30',
        'configuracion.celular_secundario' => 'nullable|max:9',
        'configuracion.correo_secundario' => 'nullable|max:30',
        'configuracion.link_facebook' => 'nullable|url|max:50',
        'configuracion.link_instagram' => 'nullable|url|max:50',
        'configuracion.link_youtube' => 'nullable|url|max:50',
        'configuracion.link_linkedln' => 'nullable|url|max:50',
    ];

   protected $messages = [
        'configuracion.celular_principal.required' => 'El teléfono/celular principal es obligatorio.',
        'configuracion.correo_principal.required' => 'El correo principal es obligatorio.',
        'configuracion.celular_principal.max' => 'El teléfono/celular principal debe tener un máximo de 9 caracteres.',
        'configuracion.correo_principal.max' => 'El correo principal debe tener un máximo de 30 caracteres.',
        'configuracion.celular_secundario.max' => 'El teléfono/celular secundario debe tener un máximo de 9 caracteres.',
        'configuracion.correo_secundario.max' => 'El correo secundario debe tener un máximo de 30 caracteres.',
        'configuracion.link_facebook.max' => 'El link de Facebook debe tener un máximo de 50 caracteres.',
        'configuracion.link_instagram.max' => 'El link de Instagram debe tener un máximo de 50 caracteres.',
        'configuracion.link_youtube.max' => 'El link de Youtube debe tener un máximo de 50 caracteres.',
        'configuracion.link_linkedln.max' => 'El link de Linkedln debe tener un máximo de 50 caracteres.',
        'configuracion.link_facebook.url' => 'El link de Facebook debe ser una URL.',
        'configuracion.link_instagram.url' => 'El link de Instagram debe ser una URL.',
        'configuracion.link_youtube.url' => 'El link de Youtube debe ser una URL.',
        'configuracion.link_linkedln.url' => 'El link de Linkedln debe ser una URL.',
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
        return view('livewire.configuracion.contacto-component');
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
        $this->dispatchBrowserEvent('showModalContacto');
    }

    public function closeModal(){
        $this->verModal=false;
        $this->dispatchBrowserEvent('closeModalContacto');
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
        if ($this->configuracion==$this->configuracionOriginal){
            $this->closeModal();
            $this->dispatchBrowserEvent('info',['mensaje' => 'El registro no ha sufrido cambios!']);
        }else{
            $this->configuracion->save();
            $this->closeModal();
            $this->configuracion=Configuracion::first(); //CONSULTA LOS VALORES GUARDADOS EN BD
            $this->configuracionOriginal=$this->configuracion; //LE ASIGAN AL AUXILIAR DE ORIGINAL PARA UNA POSTERIOR EDICIÓN
            $this->dispatchBrowserEvent('success',['mensaje' => 'El registro se ha guardado correctamente!']);
        }

    }

}
