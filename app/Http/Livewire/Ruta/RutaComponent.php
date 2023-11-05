<?php

namespace App\Http\Livewire\Ruta;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Ruta;
use App\Models\Ciudad;
use App\Models\TipoBus;
use Illuminate\Database\Eloquent\Collection;

class RutaComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $ruta;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    public function mount(){
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->ruta=new Ruta();
    }

     public function updatingSearch(){
        $this->resetPage();
    }

    protected function rules(){
        return [
           'ruta.hora_salida' => 'required',
           'ruta.hora_llegada' => 'required',
           'ruta.ciudad_origen_id' => 'required',
           'ruta.ciudad_destino_id' => 'required',
           'ruta.tipo_bus_id' => 'required',
        ];
   }

   protected $messages = [
        'ruta.hora_salida.required' => 'La hora de salida es requerida',
        'ruta.hora_llegada.required' => 'La hora de llegada es requerida',
        'ruta.ciudad_origen_id.required' => 'La ciudad de origen es requerida',
        'ruta.ciudad_destino_id.required' => 'La ciudad de destino es requerida',
        'ruta.tipo_bus_id.required' => 'El tipo de bus es requerido',
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
           $this->ruta = new Ruta();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $rutas=Ruta::where('hora_salida', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        $tipo_buses=TipoBus::where('estado','=','1')->get();
        return view('livewire.ruta.ruta-component', compact('rutas','ciudades','tipo_buses'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->ruta->save();
        session()->flash('message', 'Ruta registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function cambiarEstado($id){
        $ruta = Ruta::find($id);
        if($ruta->estado == 1){
            $ruta->update(['estado' => '0']);
        }else{
            $ruta->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Ruta actualizado con éxito'); 
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->ruta=Ruta::find($id);
    }

    public function update(){
        $this->validate();
        $this->ruta->update();
        session()->flash('message', 'Ruta actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }


}
