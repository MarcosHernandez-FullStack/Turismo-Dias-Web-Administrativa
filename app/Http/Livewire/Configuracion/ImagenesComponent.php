<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImagenesComponent extends Component
{
    use WithFileUploads;
    public $ruta_logo, $ruta_foto_principal, $ruta_video, $ruta_foto_header_seccion;
    public $configuracion;
    public $configuracionOriginal;
    //VARIABLE PARA VERIFICAR SI EL MODAL ESTA ABIERTO O CERRADO
    //DEBIDO A QUE LA VALIDACION  RENDERIZA DE NUEVO EL COMPONENTE, SE CIERRA AUTOMATICAMENTE
    public $verModal = false;
    public $tab = 'ruta_logo_tab';

    //DEFINICION DE REGLAS DE VALIDACION
    //LA VALIDACIOND E LAS IMAGENES SE HACE CON FILEPOND
    protected $rules = [
        'ruta_foto_principal' => 'image|nullable',
        'configuracion.ruta_video' => 'nullable|url|max:255',
        'ruta_foto_header_seccion' => 'image|nullable',
        'ruta_logo' => 'image|nullable',
    ];

    protected $messages = [
        'ruta_foto_principal.image' => 'El archivo debe ser de tipo imagen.',
        'configuracion.ruta_video.url' => 'El texto debe ser una URL embebida.',
        'ruta_foto_header_seccion.image' => 'El archivo debe ser de tipo imagen.',
        'ruta_logo.image' => 'El archivo debe ser de tipo imagen.',
        'configuracion.ruta_video.max' => 'El tamaño máximo de la URL es de 255 caracteres.',
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
        return view('livewire.configuracion.imagenes-component');
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
        $this->limpiarImagenes();
        $this->verModal = true;
        $this->dispatchBrowserEvent('showModalImagenes');
    }

    public function closeModal()
    {
        $this->verModal = false;
        $this->dispatchBrowserEvent('closeModalImagenes');
    }

    public function cambiarTab($tab)
    {
        $this->tab = $tab;
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save()
    {
        try {
            $this->validate();
            if ($this->ruta_logo) {
                if ($this->ruta_logo != $this->configuracion->ruta_logo) {
                    if (Storage::exists($this->configuracion->ruta_logo)) {
                        Storage::delete($this->configuracion->ruta_logo);
                    }
                    $this->configuracion->ruta_logo = $this->ruta_logo->store('public/configuracion');
                }
            }
            if ($this->ruta_foto_principal) {
                if ($this->ruta_foto_principal != $this->configuracion->ruta_foto_principal) {
                    if (Storage::exists($this->configuracion->ruta_foto_principal)) {
                        Storage::delete($this->configuracion->ruta_foto_principal);
                    }
                    $this->configuracion->ruta_foto_principal = $this->ruta_foto_principal->store('public/configuracion');
                }
            }
            if ($this->ruta_foto_header_seccion) {
                if ($this->ruta_foto_header_seccion != $this->configuracion->ruta_foto_header_seccion) {
                    if (Storage::exists($this->configuracion->ruta_foto_header_seccion)) {
                        Storage::delete($this->configuracion->ruta_foto_header_seccion);
                    }
                    $this->configuracion->ruta_foto_header_seccion = $this->ruta_foto_header_seccion->store('public/configuracion');
                }
            }
            if ($this->configuracion == $this->configuracionOriginal) {
                $this->closeModal();
                $this->cambiarTab('ruta_foto_principal_tab');
                $this->dispatchBrowserEvent('info', ['mensaje' => 'El registro no ha sufrido cambios!']);
            } else {
                $this->configuracion->save();
                $this->closeModal();
                $this->cambiarTab('ruta_foto_principal_tab');
                $this->configuracion = Configuracion::first(); //CONSULTA LOS VALORES GUARDADOS EN BD
                $this->configuracionOriginal = $this->configuracion; //LE ASIGAN AL AUXILIAR DE ORIGINAL PARA UNA POSTERIOR EDICIÓN
                $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        $this->limpiarImagenes();
    }

    public function limpiarImagenes()
    {
        $this->ruta_foto_principal = null;
        $this->ruta_foto_header_seccion = null;
        $this->dispatchBrowserEvent('removerImagenes');
    }
}
