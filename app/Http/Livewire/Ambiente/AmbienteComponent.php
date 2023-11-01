<?php

namespace App\Http\Livewire\Ambiente;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Ambiente;
use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Collection;

class AmbienteComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $ambiente;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6; 

    public function mount(){
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form'; 
        $this->ambiente=new Ambiente();
    }

     public function updatingSearch(){
        $this->resetPage();
    }

    protected function rules(){
        return [
           'ambiente.nombre' => 'required',
           'ambiente.tipo' => 'required',
           'ambiente.coordenada_longitud' => 'required',
           'ambiente.coordenada_latitud' => 'required',
           'ambiente.direccion' => 'required',
           'ambiente.horario_atencion' => 'required',
           'ambiente.telefono' => 'required',
           'ambiente.ciudad_id' => 'required',
        ];
   }

   protected $messages = [
         'ambiente.nombre.required' => 'El nombre del ambiente es requerido',
         'ambiente.tipo.required' => 'El tipo de ambiente es requerido',
         'ambiente.coordenada_longitud.required' => 'La coordenada longitud es requerida',
         'ambiente.coordenada_latitud.required' => 'La coordenada latitud es requerida',
         'ambiente.direccion.required' => 'La dirección es requerida',
         'ambiente.horario_atencion.required' => 'El horario de atención es requerido',
         'ambiente.telefono.required' => 'El teléfono es requerido',
         'ambiente.ciudad_id.required' => 'La ciudad es requerida',
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
           $this->ambiente = new Ambiente();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render(){
        $ambientes=Ambiente::where('nombre', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        return view('livewire.ambiente.ambiente-component', compact('ambientes','ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->ambiente->save();
        session()->flash('message', 'Ambiente registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function cambiarEstado($id){
        $ambiente = Ambiente::find($id);
        if($ambiente->estado == 1){
            $ambiente->update(['estado' => '0']);
        }else{
            $ambiente->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Ambiente actualizado con éxito'); 
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->ambiente=Ambiente::find($id);
    }

    public function update(){
        $this->validate();
        $this->ambiente->update();
        session()->flash('message', 'Ambiente actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }
}
