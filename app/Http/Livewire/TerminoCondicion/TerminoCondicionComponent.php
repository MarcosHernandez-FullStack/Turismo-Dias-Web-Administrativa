<?php

namespace App\Http\Livewire\TerminoCondicion;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\TerminoCondicion;
use Illuminate\Database\Eloquent\Collection;

class TerminoCondicionComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $termino_condicion;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    public function mount()
    {
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->termino_condicion=new TerminoCondicion();
    }

     public function updatingSearch(){
        $this->resetPage();
    }

    protected function rules(){
        return [
           'termino_condicion.seccion' => 'required',
           'termino_condicion.descripcion' => 'required',
        ];
   }

   protected $messages = [
            'termino_condicion.seccion.required' => 'La seccion es requerida',
            'termino_condicion.descripcion.required' => 'La descripcion es requerida',
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
           $this->termino_condicion = new TerminoCondicion();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $termino_condiciones=TerminoCondicion::where('seccion', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        return view('livewire.termino_condicion.termino_condicion-component', compact('termino_condiciones'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->termino_condicion->save();
        session()->flash('message', 'TerminoCondicion registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function cambiarEstado($id){
        $termino_condicion = TerminoCondicion::find($id);
        if($termino_condicion->estado == 1){
            $termino_condicion->update(['estado' => '0']);
        }else{
            $termino_condicion->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Termino Condicion actualizado con éxito');  
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->termino_condicion=TerminoCondicion::find($id);
    }

    public function update(){
        $this->validate();
        $this->termino_condicion->update();
        session()->flash('message', 'TerminoCondicion actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }


}
