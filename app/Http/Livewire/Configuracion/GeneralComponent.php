<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Configuracion;
use Livewire\Component;

class GeneralComponent extends Component
{
    public $configuracion;
    public $configuracionOriginal;
    //VARIABLE PARA VERIFICAR SI EL MODAL ESTA ABIERTO O CERRADO
    //DEBIDO A QUE LA VALIDACION  RENDERIZA DE NUEVO EL COMPONENTE, SE CIERRA AUTOMATICAMENTE
    public $verModal = false;

    //DEFINICION DE REGLAS DE VALIDACION
    protected $rules = [
        'configuracion.razon_social' => 'required|max:50',
        'configuracion.nombre' => 'required|max:50',
        'configuracion.slogan' => 'required|max:80',
        'configuracion.horario_atencion_principal' => 'required|max:30',
    ];

    protected $messages = [
        'configuracion.razon_social.required' => 'La razón social es obligatoria.',
        'configuracion.nombre.required' => 'El nombre es obligatorio.',
        'configuracion.slogan.required' => 'El eslogan es obligatorio.',
        'configuracion.horario_atencion_principal.required' => 'El horario de atención principal es obligatorio.',
        'configuracion.razon_social.max' => 'La razón social debe tener 50 caracteres como máximo.',
        'configuracion.nombre.max' => 'El nombre debe tener 50 caracteres como máximo.',
        'configuracion.slogan.max' => 'El eslogan debe tener 80 caracteres como máximo.',
        'configuracion.horario_atencion_principal.max' => 'El horario de atención principal debe tener 30 caracteres como máximo.',
    ];

    //SE VERIFICA SI EXISTE LA CONFIGURACON, DE LO CONTRARIO CREA UNA
    public function mount()
    {
        try {
            $this->configuracion = Configuracion::first();
        } catch (\Exception $e) {
            $this->configuracion = null;
        }

        if (!isset($this->configuracion)) {
            $this->configuracion = new Configuracion();
        }
        $this->configuracionOriginal = $this->configuracion;
    }

    public function render()
    {
        return view('livewire.configuracion.general-component');
    }

    //FUNCION PARA MOSTRAR ERRORES DE VALIDACION EN TIEMPO REAL
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //FUNCION PARA RESETEAR VARIABLES Y ERRORES DE VALIDACION
    public function resetError()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //FUNCION PARA RESETEAR VALORES DE MI VARIABLE
    //EVITA ESTAR CONSULTANDO CONTINUAMENTE AL ABRIR EL MODAL
    public function resetValues()
    {
        $this->configuracion = $this->configuracionOriginal;
    }

    public function showModal()
    {
        $this->resetError();
        $this->resetValues();
        $this->verModal = true;
        $this->dispatchBrowserEvent('showModalGeneral');
    }

    public function closeModal()
    {
        $this->verModal = false;
        $this->dispatchBrowserEvent('closeModalGeneral');
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save()
    {
        $this->validate();
        try {
            if ($this->configuracion == $this->configuracionOriginal) {
                $this->closeModal();
                $this->dispatchBrowserEvent('info', ['mensaje' => 'El registro no ha sufrido cambios!']);
            } else {
                $this->configuracion->save();
                $this->closeModal();
                $this->configuracion = Configuracion::first(); //CONSULTA LOS VALORES GUARDADOS EN BD
                $this->configuracionOriginal = $this->configuracion; //LE ASIGAN AL AUXILIAR DE ORIGINAL PARA UNA POSTERIOR EDICIÓN
                $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
    }

}
