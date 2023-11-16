<?php

namespace App\Http\Livewire\LibroReclamacion;

use App\Models\LibroReclamacion;
use Livewire\Component;
use Livewire\WithPagination;

class LibroReclamacionComponent extends Component
{
    use WithPagination;
    public $reclamo;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;
    public $filtroEstado = '1';
    public $filtroEstadoMsg;
    public $tab = 'reclamante';
    public $fechaIntroducida;

    public function mount()
    {
        $this->sort = 'id';
        $this->direction = 'asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->reclamo = new LibroReclamacion();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    protected function rules()
    {
        return [
            'reclamo.estado' => 'required',
        ];
    }

    protected $messages = [
        'reclamo.estado.required' => 'Es obligatorio que elija un estado para este reclamo.',
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
            $this->reclamo = new LibroReclamacion();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('openModal');
    }

    public function render()
    {
        $reclamos = [];
        $nroReclamosNuevos = null;
        try {
            $fechaIntroducida = $this->fechaIntroducida;
            if ($this->filtroEstado !== null) {
                if ($this->filtroEstado == '3') {
                    $reclamos = LibroReclamacion::when($fechaIntroducida, function ($query) use ($fechaIntroducida) {
                        $query->whereDate('created_at', '=', $fechaIntroducida);
                    })->when($this->filtroEstadoMsg != "", function ($query) {
                        $query->where('estado', '=', $this->filtroEstadoMsg);
                    })->where('tipo_reclamacion_detalle', '=', $this->filtroEstado)->orderBy('created_at', 'desc')->paginate($this->paginacion);
                } else {
                    $reclamos = LibroReclamacion::when($fechaIntroducida, function ($query) use ($fechaIntroducida) {
                        $query->whereDate('created_at', '=', $fechaIntroducida);
                    })->where('estado', '=', $this->filtroEstado)->orderBy('created_at', 'desc')->paginate($this->paginacion);
                }
            } else {
                $reclamos = LibroReclamacion::when($fechaIntroducida, function ($query) use ($fechaIntroducida) {
                    $query->whereDate('created_at', '=', $fechaIntroducida);
                })->orderBy('created_at', 'desc')->paginate($this->paginacion);
            }
            $nroReclamosNuevos = LibroReclamacion::where('estado', '=', '1')->count();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
        return view('livewire.libro-reclamacion.libro-reclamacion-component', compact('reclamos', 'nroReclamosNuevos'))
            ->extends('layouts.principal')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        try {
            $this->reclamo->save();
            $this->dispatchBrowserEvent('closeModal');
            $this->cambiarTab('reclamante');
            $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }

    }

    public function edit($id)
    {
        try {
            $this->reclamo = LibroReclamacion::find($id);
            $this->showModal("form", "update");
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['mensaje' => strtok($e->getMessage(), ".")]);
        }
    }

    public function cambiarTab($tab)
    {
        $this->tab = $tab;
    }

    public function cambiarFiltroEstado($filtroEstado)
    {
        $this->filtroEstado = $filtroEstado;
    }

    public function refrescarTabla()
    {
        $this->render();
    }
}
