<?php

namespace App\Http\Livewire\TerminoCondicion;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\TerminoCondicion;
use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Collection;

class TerminoCondicionComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $termino_condicion,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1,$foto_principal_guardada,$foto_secundaria_guardada;
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
        $this->termino_condicion=new TerminoCondicion();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'termino_condicion.seccion' => 'required',
           'termino_condicion.descripcion' => 'required',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
            'termino_condicion.seccion.required' => 'La seccion es requerida',
            'termino_condicion.descripcion.required' => 'La descripcion es requerida',
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
           $this->termino_condicion = new TerminoCondicion();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->beneficios_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $termino_condiciones=TerminoCondicion::where('seccion', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        return view('livewire.termino_condicion.termino_condicion-component', compact('termino_condiciones','ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();

        $servicioCreado= new TerminoCondicion();
        $servicioCreado=$this->termino_condicion;
        $servicioCreado->save();
        session()->flash('message', 'TerminoCondicion registrado con éxito');
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
        $termino_condicion = TerminoCondicion::find($id);
        if($termino_condicion->estado == 1){
            $termino_condicion->update(['estado' => '0']);
        }else{
            $termino_condicion->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del TerminoCondicion actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->termino_condicion=TerminoCondicion::find($id);
       /*  $this->ruta_foto_principal=$this->termino_condicion->ruta_foto_principal;
        $this->ruta_foto_secundaria=$this->termino_condicion->ruta_foto_secundaria; */
        $this->foto_principal_guardada = $this->termino_condicion->ruta_foto_principal;
        $this->foto_secundaria_guardada = $this->termino_condicion->ruta_foto_secundaria;
        $this->beneficio_id=-1;
       /*  $this->reset('ruta_foto_principal','ruta_foto_secundaria'); */
    }

    public function update(){
        /* if($this->termino_condicion->) */
       /*  if($this->ruta_foto_principal) 
            $this->termino_condicion->ruta_foto_principal = $this->ruta_foto_principal->store('public/termino_condiciones/principal');
        else
            $this->termino_condicion->ruta_foto_principal=$this->termino_condicion->ruta_foto_principal;
        if($this->ruta_foto_secundaria) 
            $this->termino_condicion->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/termino_condiciones/secundaria');
        else
            $this->termino_condicion->ruta_foto_secundaria=$this->termino_condicion->ruta_foto_secundaria; */

        $this->validate();
        $this->termino_condicion->update();
        session()->flash('message', 'TerminoCondicion actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }


}
