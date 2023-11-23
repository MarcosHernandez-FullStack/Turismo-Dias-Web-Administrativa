<?php

namespace App\Http\Livewire\Servicios;

use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ServicioComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $servicio, $ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    protected $listeners = ['cambiar-estado' => 'cambiarEstado'];

    public function mount()
    {
        $this->sort = 'id';
        $this->direction = 'asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->servicio = new Servicio();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return $this->form == 'create'
        ? [
            'servicio.nombre' => 'required|max:35',
            'servicio.descripcion' => 'required|max:100',
            'ruta_foto' => 'image',
        ]
        : [
            'servicio.nombre' => 'required|max:35',
            'servicio.descripcion' => 'required|max:120',
            'ruta_foto' => 'image|nullable',
        ];
    }

    protected $messages = [
        'servicio.nombre.required' => 'El nombre del servicio es obligatorio.',
        'servicio.descripcion.required' => 'La descripción del servicio es obligatoria.',
        'ruta_foto.required' => 'La foto para el servicio es obligatoria.',
        'servicio.nombre.max' => 'El nombre del servicio debe tener un máximo de 35 caracteres.',
        'servicio.descripcion.max' => 'La descripción del servicio debe tener un máximo de 120 caracteres.',
        'ruta_foto.image' => 'El archivo debe ser de tipo imagen.',
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
        $this->limpiarImagenes();
        if ($form == 'create') {
            $this->servicio = new Servicio();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('openModal');
    }

    public function render()
    {
        $servicios = [];
        try {
            $servicios = Servicio::where('nombre', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)->paginate($this->paginacion);
            $this->dispatchBrowserEvent('inicializaPopovers');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        return view('livewire.servicios.servicio-component', compact('servicios'))
            ->extends('layouts.principal')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        try {
            if ($this->ruta_foto) {
                if ($this->ruta_foto != $this->servicio->ruta_foto) {
                    if (Storage::exists($this->servicio->ruta_foto)) {
                        Storage::delete($this->servicio->ruta_foto);
                    }
                    $this->servicio->ruta_foto = $this->ruta_foto->store('public/servicio');
                }
            }
            $this->servicio->save();
            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
            $this->dispatchBrowserEvent('inicializaPopovers');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        $this->limpiarImagenes();
    }

    public function edit($id)
    {
        try {
            $this->servicio = Servicio::find($id);
            $this->showModal("form", "update");
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
    }

    public function confirmarCambioEstado($id)
    {
        try {
            $servicio = Servicio::find($id);
            $this->dispatchBrowserEvent('mostrar-confirmacion', [
                'mensaje' => '¿Estás seguro de que deseas ' . (($servicio->estado == 1) ? 'desactivar' : 'activar') . ' este servicio?',
                'evento' => 'cambiar-estado',
                'data' => $id,
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function cambiarEstado($id)
    {
        try {
            $servicio = Servicio::find($id);
            if ($servicio->estado == 1) {
                $servicio->update(['estado' => '0']);
            } else {
                $servicio->update(['estado' => '1']);
            }
            //$this->dispatchBrowserEvent('success', ['mensaje' => 'El servicio ha sido ' . (($servicio->estado == 1) ? 'activado' : 'desactivado') . '!']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function limpiarImagenes()
    {
        $this->ruta_foto = null;
        $this->dispatchBrowserEvent('removerImagenes');
    }

}
