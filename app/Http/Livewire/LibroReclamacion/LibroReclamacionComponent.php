<?php

namespace App\Http\Livewire\LibroReclamacion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LibroReclamacion;
use Illuminate\Database\Eloquent\Collection;

class LibroReclamacionComponent extends Component
{
    use WithPagination;
    public $reclamo;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6; 
    public $filtroEstado='1';
    public $tab = 'reclamante';

    public function mount(){
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form'; 
        $this->reclamo=new LibroReclamacion();
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    protected function rules(){
        return [
           'reclamo.estado' => 'required',
        ];
    }

    protected $messages = [
            'reclamo.estado.required' => 'Es obligatorio que elija un estado para este reclamo.',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
 
    public function resetError(){
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function showModal($vista, $form){
        $this->resetError();
        if($form == 'create'){
            $this->reclamo = new LibroReclamacion();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('openModal');
    }

    public function render()
    {
        if ($this->filtroEstado!== null){
            $reclamos=LibroReclamacion::where('estado','=',$this->filtroEstado)->paginate($this->paginacion);
        }else{
            $reclamos=LibroReclamacion::paginate($this->paginacion);
        }
        return view('livewire.libro-reclamacion.libro-reclamacion-component',compact('reclamos'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->reclamo->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->cambiarTab('reclamante');
        $this->dispatchBrowserEvent('success',['mensaje' => 'El registro se ha guardado correctamente!']);
        
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->reclamo=LibroReclamacion::find($id);
    }

    public function cambiarTab($tab){
        $this->tab=$tab;
    }

    public function cambiarFiltroEstado($filtroEstado){
        $this->filtroEstado=$filtroEstado;
    }
    
}
