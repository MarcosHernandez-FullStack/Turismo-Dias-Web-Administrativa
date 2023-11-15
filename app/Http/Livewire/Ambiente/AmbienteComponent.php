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

    protected $listeners = ['cambiar-estado' => 'cambiarEstado'];

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
           'ambiente.nombre' => 'required|max:30',
           'ambiente.tipo' => 'required',
           'ambiente.coordenada_longitud' => 'required|numeric|between:-999999.9999999999,999999.9999999999',
           'ambiente.coordenada_latitud' => 'required|numeric|between:-999999.9999999999,999999.9999999999',
           'ambiente.direccion' => 'required|max:100',
           'ambiente.horario_atencion' => 'required|max:150',
           'ambiente.telefono' => 'required|max:13',
           'ambiente.ciudad_id' => 'required',
        ];
   }

   protected $messages = [
        'ambiente.nombre.required' => 'El nombre del ambiente es requerido',
        'ambiente.nombre.max' => 'El nombre del ambiente debe contener como máximo 30 caracteres',
        'ambiente.tipo.required' => 'El tipo de ambiente es requerido',
        'ambiente.coordenada_longitud.required' => 'La coordenada longitud es requerida',
        'ambiente.coordenada_longitud.numeric' => 'La coordenada longitud debe ser un número',
        'ambiente.coordenada_longitud.between' => 'La coordenada longitud debe estar entre -999999.9999999999 y 999999.9999999999',
        'ambiente.coordenada_latitud.required' => 'La coordenada latitud es requerida',
        'ambiente.coordenada_latitud.numeric' => 'La coordenada latitud debe ser un número',
        'ambiente.coordenada_latitud.between' => 'La coordenada latitud debe estar entre -999999.9999999999 y 999999.9999999999',
        'ambiente.direccion.required' => 'La dirección es requerida',
        'ambiente.direccion.max' => 'La dirección debe contener como máximo 100 caracteres',
        'ambiente.horario_atencion.required' => 'El horario de atención es requerido',
        'ambiente.horario_atencion.max' => 'El horario de atención debe contener como máximo 150 caracteres',
        'ambiente.telefono.required' => 'El teléfono es requerido',
        'ambiente.telefono.max' => 'El teléfono debe contener como máximo 13 caracteres',
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
        $ambientes=Ambiente::where('nombre', 'like', '%'.$this->search.'%')
        ->orWhere('tipo', 'like', '%'.$this->search.'%')
        ->orWhere('direccion', 'like', '%'.$this->search.'%')
        ->orWhere('horario_atencion', 'like', '%'.$this->search.'%')
        ->orWhere('telefono', 'like', '%'.$this->search.'%')
        ->orWhereHas('ciudad', function($query){
            $query->where('descripcion', 'like', '%'.$this->search.'%');
        })
        ->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        return view('livewire.ambiente.ambiente-component', compact('ambientes','ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->ambiente->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function confirmarCambioEstado($id)
    {
        $ambiente = Ambiente::find($id);
        $this->dispatchBrowserEvent('mostrar-confirmacion', [
            'mensaje' => '¿Estás seguro de que deseas '.(($ambiente->estado == 1) ? 'desactivar':'activar').' este ambiente?',
            'evento' => 'cambiar-estado',
            'data' => $id,
        ]);
    }

    public function cambiarEstado($id){
        $ambiente = Ambiente::find($id);
        if($ambiente->estado == 1){
            $ambiente->update(['estado' => '0']);
        }else{
            $ambiente->update(['estado' => '1']);
        }
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El ambiente ha sido '.(($ambiente->estado == 1) ? 'activado':'desactivado').'!']);
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->ambiente=Ambiente::find($id);
    }

    public function update(){
        $this->validate();
        $this->ambiente->update();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function detail($id){
        $this->showModal("form", "detail");
        $this->ambiente=Ambiente::find($id);
    }
}
