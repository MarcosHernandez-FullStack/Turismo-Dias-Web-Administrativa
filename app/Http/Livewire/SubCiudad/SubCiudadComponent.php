<?php

namespace App\Http\Livewire\SubCiudad;

use App\Models\Ciudad;
use App\Models\SubCiudad;
use Livewire\Component;

class SubCiudadComponent extends Component
{
    public $ciudad, $subCiudad;
    public $form;
    protected $listeners = ['enviarCiudad' => 'recepcionarCiudad',
        'cambiar-estado-subciudad' => 'cambiarEstado'];

    public function mount()
    {
        $this->form = 'create';
        $this->subCiudad = new SubCiudad();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'subCiudad.descripcion' => 'required|max:50',
        ];
    }

    protected $messages = [
        'subCiudad.descripcion.required' => 'La descripción de la Sub-Ciudad es obligatoria.',
        'subCiudad.descripcion.max' => 'La descripción de la Sub-Ciudad debe tener un máximo de 50 caracteres.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetError()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function recepcionarCiudad($ciudadId)
    {
        try {
            $this->ciudad = Ciudad::find($ciudadId);
            $this->mount();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);

        }
    }

    public function render()
    {
        $subciudades = [];
        try {
            if ($this->ciudad) {
                $subciudades = SubCiudad::where('ciudad_id', $this->ciudad->id)->get();
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        return view('livewire.sub-ciudad.sub-ciudad-component', compact('subciudades'));
    }

    public function save()
    {
        if ($this->ciudad) {
            $this->validate();
        }
        try {
            if ($this->ciudad) {
                $this->subCiudad->ciudad_id = $this->ciudad->id;
                $this->subCiudad->save();
                $this->mount();
                $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
                $this->emit('actualizaCiudades');
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function edit($id)
    {
        try {
            $this->subCiudad = SubCiudad::find($id);
            $this->form = 'update';
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function cancelar()
    {
        try {
            $this->mount();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function confirmarCambioEstado($id)
    {
        try {
            $subCiudad = SubCiudad::find($id);
            $this->dispatchBrowserEvent('mostrar-confirmacion', [
                'mensaje' => '¿Estás seguro de que deseas ' . (($subCiudad->estado == 1) ? 'desactivar' : 'activar') . ' esta Sub-Ciudad?',
                'evento' => 'cambiar-estado-subciudad',
                'data' => $id,
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function cambiarEstado($id)
    {
        try {
            $subCiudad = SubCiudad::find($id);
            if ($subCiudad->estado == 1) {
                $subCiudad->update(['estado' => '0']);
            } else {
                $subCiudad->update(['estado' => '1']);
            }
            $this->dispatchBrowserEvent('success', ['mensaje' => 'La Sub-Ciudad ha sido ' . (($subCiudad->estado == 1) ? 'activada' : 'desactivada') . '!']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
    }
}
