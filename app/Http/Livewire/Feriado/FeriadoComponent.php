<?php

namespace App\Http\Livewire\Feriado;

use App\Models\Feriado;
use Livewire\Component;
use Livewire\WithPagination;

class FeriadoComponent extends Component
{
    use WithPagination;
    public $feriado;
    public $searchRazon,$searchFechaInicio,$searchMes,$searchAnio;
    public $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    protected $listeners = ['cambiar-estado' => 'cambiarEstado'];

    public function mount()
    {
        $this->sort = 'fecha_inicio';
        $this->direction = 'asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->feriado = new Feriado();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'feriado.razon' => 'required|max:50',
            'feriado.fecha_inicio' => 'required|date',
            'feriado.fecha_fin' => 'nullable|date|after_or_equal:feriado.fecha_inicio',
        ];
    }

    protected $messages = [
        'feriado.razon.required' => 'La razón del feriado es obligatorio.',
        'feriado.razon.max' => 'La razón del feriado debe tener como máximo 50 caracteres.',
        'feriado.fecha_inicio.required' => 'La fecha de inicio del feriado es obligatoria.',
        'feriado.fecha_inicio.date' => 'La fecha de inicio del feriado debe ser de tipo fecha.',
        //'feriado.fecha_fin.required' => 'La fecha de fin del feriado es obligatoria.',
        'feriado.fecha_fin.date' => 'La fecha de fin del feriado debe ser de tipo fecha.',
        'feriado.fecha_fin.after_or_equal' => 'La fecha de fin del feriado no puede ser anterior a la fecha de inicio.',
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
            $this->feriado = new Feriado();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('openModal');
    }

    public function render()
    {
        $anios=Feriado::selectRaw('YEAR(fecha_inicio) as anio')
        ->distinct()
        ->orderBy('anio', 'asc')
        ->pluck('anio');
        $feriados = Feriado::where('razon', 'like', '%' . $this->searchRazon . '%')
            ->when($this->searchFechaInicio,function ($query) {
            $query->whereDate('fecha_inicio', '=', $this->searchFechaInicio);
        })
        ->when($this->searchMes!=0,function ($query) {
            $query->whereMonth('fecha_inicio', '=', $this->searchMes);
        })
        ->when($this->searchAnio!=0,function ($query) {
            $query->whereYear('fecha_inicio', '=', $this->searchAnio);
        })
        ->orderBy($this->sort, $this->direction)->paginate($this->paginacion);
        return view('livewire.feriado.feriado-component', compact('feriados','anios'))
            ->extends('layouts.principal')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $this->feriado->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function edit($id)
    {
        $this->showModal("form", "update");
        $this->feriado = Feriado::find($id);
    }

    public function confirmarCambioEstado($id)
    {
        $feriado = Feriado::find($id);
        $this->dispatchBrowserEvent('mostrar-confirmacion', [
            'mensaje' => '¿Estás seguro de que deseas '.(($feriado->estado == 1) ? 'desactivar':'activar').' este feriado?',
            'evento' => 'cambiar-estado',
            'data' => $id,
        ]);
    }

    public function cambiarEstado($id){
        $feriado = Feriado::find($id);
        if($feriado->estado == 1){
            $feriado->update(['estado' => '0']);
        }else{
            $feriado->update(['estado' => '1']);
        }
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El feriado ha sido '.(($feriado->estado == 1) ? 'activado':'desactivado').'!']);
    }
}
