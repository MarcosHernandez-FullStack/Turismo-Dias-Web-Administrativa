<?php

namespace App\Http\Livewire\Ruta;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Ruta;
use App\Models\Ciudad;
use App\Models\SubCiudad;
use App\Models\TipoBus;
use Illuminate\Database\Eloquent\Collection;

class RutaComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $ruta;
    public $sub_ciudades_origenes = [];
    public $sub_ciudades_destinos = [];
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
           'ruta.sub_ciudad_origen_id' => (count($this->sub_ciudades_origenes)) ? 'required' : '' ,
           'ruta.sub_ciudad_destino_id' => (count($this->sub_ciudades_destinos)) ? 'required' : '' ,
        ];
   }

   protected $messages = [
        'ruta.hora_salida.required' => 'La hora de salida es requerida',
        'ruta.hora_llegada.required' => 'La hora de llegada es requerida',
        'ruta.ciudad_origen_id.required' => 'La ciudad de origen es requerida',
        'ruta.ciudad_destino_id.required' => 'La ciudad de destino es requerida',
        'ruta.tipo_bus_id.required' => 'El tipo de bus es requerido',
        'ruta.sub_ciudad_origen_id.required' => 'La sub ciudad de origen es requerida',
        'ruta.sub_ciudad_destino_id.required' => 'La sub ciudad de destino es requerida',
   ];

    public function updatedRutaCiudadOrigenId(){
        $this->sub_ciudades_origenes = ($this->ruta->ciudad_origen_id)?SubCiudad::where('ciudad_id', $this->ruta->ciudad_origen_id)->get():[];
        $this->ruta->sub_ciudad_origen_id = null;
    }

    public function updatedRutaCiudadDestinoId(){
        $this->sub_ciudades_destinos = ($this->ruta->ciudad_destino_id)?SubCiudad::where('ciudad_id', $this->ruta->ciudad_destino_id)->get():[];
        $this->ruta->sub_ciudad_destino_id = null;
    }

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
        $rutas=Ruta::where('hora_salida', 'like', '%'.$this->search.'%')
        ->orWhere('hora_llegada', 'like', '%'.$this->search.'%')
        ->orWhereHas('ciudad_origen', function($query){
            $query->where('descripcion', 'like', '%'.$this->search.'%');
        })
        ->orWhereHas('ciudad_destino', function($query){
            $query->where('descripcion', 'like', '%'.$this->search.'%');
        })
        ->orWhereHas('tipo_bus', function($query){
            $query->where('nombre', 'like', '%'.$this->search.'%');
        })
        ->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        $tipo_buses=TipoBus::where('estado','=','1')->get();
        if (!$this->ruta->ciudad_origen_id) $this->sub_ciudades_origenes = [];
        if (!$this->ruta->ciudad_destino_id) $this->sub_ciudades_destinos = [];
        return view('livewire.ruta.ruta-component', compact('rutas','ciudades','tipo_buses'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        if($this->ruta->sub_ciudad_origen_id) $this->ruta->ciudad_origen_id = null;
        if($this->ruta->sub_ciudad_destino_id) $this->ruta->ciudad_destino_id = null;
        $this->ruta->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function confirmarCambioEstado($id)
    {
        $ruta = Ruta::find($id);
        $this->dispatchBrowserEvent('mostrar-confirmacion', [
            'mensaje' => '¿Estás seguro de que deseas '.(($ruta->estado == 1) ? 'desactivar':'activar').' esta ruta?',
            'evento' => 'cambiar-estado',
            'data' => $id,
        ]);
    }

    public function cambiarEstado($id){
        $ruta = Ruta::find($id);
        if($ruta->estado == 1){
            $ruta->update(['estado' => '0']);
        }else{
            $ruta->update(['estado' => '1']);
        }
        $this->dispatchBrowserEvent('success', ['mensaje' => 'La ruta ha sido '.(($ruta->estado == 1) ? 'activado':'desactivado').'!']);
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->ruta=Ruta::find($id);
        if ($this->ruta->sub_ciudad_origen_id) $this->ruta->ciudad_origen_id = $this->ruta->sub_ciudad_origen->ciudad_id;
        if ($this->ruta->sub_ciudad_destino_id) $this->ruta->ciudad_destino_id = $this->ruta->sub_ciudad_destino->ciudad_id;
        $this->sub_ciudades_origenes = ($this->ruta->ciudad_origen_id)?SubCiudad::where('ciudad_id', $this->ruta->ciudad_origen_id)->get():[];
        $this->sub_ciudades_destinos = ($this->ruta->ciudad_destino_id)?SubCiudad::where('ciudad_id', $this->ruta->ciudad_destino_id)->get():[];
    }

    public function update(){
        $this->validate();
        if($this->ruta->sub_ciudad_origen_id){
            $this->ruta->ciudad_origen_id = null;
        }
        if($this->ruta->sub_ciudad_destino_id){
            $this->ruta->ciudad_destino_id = null;
        }
        $this->ruta->update();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }


}
