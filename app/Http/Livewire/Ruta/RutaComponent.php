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
    public $ruta,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1,$foto_principal_guardada,$foto_secundaria_guardada;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;
    /* public $paginacion, $paginationTheme; */

    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount()
    {
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create'; //create, update
        $this->vista = 'form'; //form
       /*  $this->paginacion = 3;
        $this->paginationTheme = 'bootstrap'; */
        $this->beneficios_collection = new Collection();
        $this->ruta=new Ruta();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'ruta.hora_salida' => 'required',
           'ruta.hora_llegada' => 'required',
           'ruta.ciudad_origen_id' => 'required',
           'ruta.ciudad_destino_id' => 'required',
           'ruta.tipo_bus_id' => 'required',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
        'ruta.hora_salida.required' => 'La hora de salida es requerida',
        'ruta.hora_llegada.required' => 'La hora de llegada es requerida',
        'ruta.ciudad_origen_id.required' => 'La ciudad de origen es requerida',
        'ruta.ciudad_destino_id.required' => 'La ciudad de destino es requerida',
        'ruta.tipo_bus_id.required' => 'El tipo de bus es requerido',
   ];

   //FUNCION PARA MOSTRAR ERRORES DE VALIDACION EN TIEMPO REAL
   public function updated($propertyName){
       $this->validateOnly($propertyName);
   }

   //FUNCION PARA RESETEAR VARIABLES Y ERRORES DE VALIDACION
   public function resetError(){
       $this->resetErrorBag();
       $this->resetValidation();
   }

   //FUNCION PARA MOSTRAR LA VISTA DEL MODAL
   public function showModal($vista, $form){
       $this->resetError();
       if($form == 'create'){
           $this->ruta = new Ruta();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->beneficios_collection = new Collection();
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


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();

        $servicioCreado= new Ruta();
        $servicioCreado=$this->ruta;
        $servicioCreado->save();
        session()->flash('message', 'Ruta registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function imprimir()
    {
        dd($this->beneficios_collection->all());
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIO
    public function rediregirProyectos($servicio_id){
        return redirect()->route('proyectos', ['servicio_id' => $servicio_id]);
    }

    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        $ruta = Ruta::find($id);
        if($ruta->estado == 1){
            $ruta->update(['estado' => '0']);
        }else{
            $ruta->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Ruta actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->ruta=Ruta::find($id);
        $this->ruta->hora_salida = date('H:i', strtotime($this->ruta->hora_salida));
        $this->ruta->hora_llegada = date('H:i', strtotime($this->ruta->hora_llegada));
    }

    public function update(){
        /* if($this->ruta->) */
       /*  if($this->ruta_foto_principal) 
            $this->ruta->ruta_foto_principal = $this->ruta_foto_principal->store('public/rutas/principal');
        else
            $this->ruta->ruta_foto_principal=$this->ruta->ruta_foto_principal;
        if($this->ruta_foto_secundaria) 
            $this->ruta->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/rutas/secundaria');
        else
            $this->ruta->ruta_foto_secundaria=$this->ruta->ruta_foto_secundaria; */

        $this->validate();
        $this->ruta->update();
        session()->flash('message', 'Ruta actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }


}
