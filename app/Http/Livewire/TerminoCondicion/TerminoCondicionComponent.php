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

    protected $listeners = ['cambiar-estado' => 'cambiarEstado'];

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
           'termino_condicion.seccion' => 'required|max:120',
           'termino_condicion.descripcion' => 'required|max:255',
        ];
   }

   protected $messages = [
            'termino_condicion.seccion.required' => 'La seccion es requerida',
            'termino_condicion.seccion.max' => 'La seccion debe contener como máximo 35 caracteres',
            'termino_condicion.descripcion.required' => 'La descripcion es requerida',
            'termino_condicion.descripcion.max' => 'La descripcion debe contener como máximo 255 caracteres',
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
           $this->emit('limpiar-descripcion');
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $termino_condiciones=TerminoCondicion::where('seccion', 'like', '%'.$this->search.'%')
        ->orWhere('descripcion', 'like', '%'.$this->search.'%')
        ->orderBy('orden')
        ->paginate($this->paginacion);
        return view('livewire.termino_condicion.termino_condicion-component', compact('termino_condiciones'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->termino_condicion->orden = count(TerminoCondicion::all())+1;
        $this->termino_condicion->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function confirmarCambioEstado($id)
    {
        $termino_condicion = TerminoCondicion::find($id);
        $this->dispatchBrowserEvent('mostrar-confirmacion', [
            'mensaje' => '¿Estás seguro de que deseas '.(($termino_condicion->estado == 1) ? 'desactivar':'activar').' este termino condicion?',
            'evento' => 'cambiar-estado',
            'data' => $id,
        ]);
    }

    public function cambiarEstado($id){
        $termino_condicion = TerminoCondicion::find($id);
        if($termino_condicion->estado == 1){
            $termino_condicion->update(['estado' => '0']);
        }else{
            $termino_condicion->update(['estado' => '1']);
        }
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El termino condicion ha sido '.(($termino_condicion->estado == 1) ? 'activado':'desactivado').'!']); 
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->termino_condicion=TerminoCondicion::find($id);
        $this->emit('cargar-descripcion', $this->termino_condicion->descripcion);
    }

    public function update(){
        $this->validate();
        $this->termino_condicion->update();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function ordenamiento ($direccion, $id){
        $termino_condicion = TerminoCondicion::find($id);
        $orden = $termino_condicion->orden;
        $termino_condicion_cambio = ($direccion == 'up') ? TerminoCondicion::where('orden', $orden-1)->first() : TerminoCondicion::where('orden', $orden+1)->first();
        $orden_cambio = $termino_condicion_cambio->orden;
        $termino_condicion_cambio->update(['orden' => $orden]);
        $termino_condicion->update(['orden' => $orden_cambio]);
        session()->flash('orden', $orden);
    }


}
