<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Configuracion;
use Livewire\Component;

class SubtitulosComponent extends Component
{
    public $configuracion;
    public $configuracionOriginal;
    //VARIABLE PARA VERIFICAR SI EL MODAL ESTA ABIERTO O CERRADO
    //DEBIDO A QUE LA VALIDACION  RENDERIZA DE NUEVO EL COMPONENTE, SE CIERRA AUTOMATICAMENTE
    public $verModal = false;

    //DEFINICION DE REGLAS DE VALIDACION
    protected $rules = [
        'configuracion.subtitulo_servicio' => 'required|max:130',
        'configuracion.subtitulo_ruta' => 'required|max:130',
        'configuracion.subtitulo_libro_reclamacion' => 'required|max:130',
        'configuracion.subtitulo_evento' => 'required|max:130',
        'configuracion.subtitulo_termino_condicion' => 'required|max:130',
    ];

    protected $messages = [
        'configuracion.subtitulo_servicio.required' => 'El Subtítulo de Servicios es obligatorio.',
        'configuracion.subtitulo_ruta.required' => 'El Subtítulo de Rutas es obligatorio.',
        'configuracion.subtitulo_libro_reclamacion.required' => 'El Subtítulo del Libro de Reclamaciones es obligatorio.',
        'configuracion.subtitulo_evento.required' => 'El Subtítulo de Eventos es obligatorio.',
        'configuracion.subtitulo_termino_condicion.required' => 'El Subtítulo de Terminos y Condiciones es obligatorio.',
        'configuracion.subtitulo_servicio.max' => 'El Subtítulo solo puede tener un máximo de 130 caracteres.',
        'configuracion.subtitulo_ruta.max' => 'El Subtítulo solo puede tener un máximo de 130 caracteres.',
        'configuracion.subtitulo_libro_reclamacion.max' => 'El Subtítulo solo puede tener un máximo de 130 caracteres.',
        'configuracion.subtitulo_evento.max' => 'El Subtítulo solo puede tener un máximo de 130 caracteres.',
        'configuracion.subtitulo_termino_condicion.max' => 'El Subtítulo solo puede tener un máximo de 130 caracteres.',
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
        return view('livewire.configuracion.subtitulos-component');
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
        $this->dispatchBrowserEvent('showModalSubtitulos');
    }

    public function closeModal()
    {
        $this->verModal = false;
        $this->dispatchBrowserEvent('closeModalSubtitulos');
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save()
    {
        try {
            $this->validate();
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
