<?php

namespace App\Http\Livewire\Ciudad;

use App\Models\Ciudad;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CiudadComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $ciudad;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    protected $listeners = ['cambiar-estado-ciudad' => 'cambiarEstado',
        'actualizaCiudades' => 'render'];

    public function mount()
    {
        $this->sort = 'id';
        $this->direction = 'asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->ciudad = new Ciudad();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'ciudad.descripcion' => 'required|max:30',
        ];
    }

    protected $messages = [
        'ciudad.descripcion.required' => 'La descripción de la Ciudad es obligatoria.',
        'ciudad.descripcion.max' => 'La descripción de la Ciudad debe tener un máximo de 30 caracteres.',
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

    public function showModal($vista, $form)
    {
        $this->resetError();
        if ($form == 'create') {
            $this->ciudad = new Ciudad();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('showModalCiudad');
    }

    public function render()
    {
        $ciudades = [];
        try {
            $ciudades = Ciudad::where('descripcion', 'like', '%' . $this->search . '%')->paginate($this->paginacion);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        return view('livewire.ciudad.ciudad-component', compact('ciudades'))
            ->extends('layouts.principal')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        try {
            $this->ciudad->save();
            $this->dispatchBrowserEvent('closeModalCiudad');
            $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function edit($id)
    {
        try {
            $this->ciudad = Ciudad::find($id);
            $this->showModal("form", "update");
            $this->emit('enviarCiudad', $id);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function confirmarCambioEstado($id)
    {
        try {
            $ciudad = Ciudad::find($id);
            $this->dispatchBrowserEvent('mostrar-confirmacion', [
                'mensaje' => '¿Estás seguro de que deseas ' . (($ciudad->estado == 1) ? 'desactivar' : 'activar') . ' esta ciudad?',
                'evento' => 'cambiar-estado-ciudad',
                'data' => $id,
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function cambiarEstado($id)
    {
        try {
            $ciudad = Ciudad::find($id);
            if ($ciudad->estado == 1) {
                $ciudad->update(['estado' => '0']);
            } else {
                $ciudad->update(['estado' => '1']);
            }
            //$this->dispatchBrowserEvent('success', ['mensaje' => 'La ciudad ha sido ' . (($ciudad->estado == 1) ? 'activada' : 'desactivada') . '!']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
    }

    public function enviarCiudad($id)
    {
        try {
            $ciudad = Ciudad::find($id);
            $this->dispatchBrowserEvent('info', ['mensaje' => 'A continuación, puedes registrar/editar las subciudades de ' . $ciudad->descripcion . '!']);
            $this->emit('enviarCiudad', $id);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

}
