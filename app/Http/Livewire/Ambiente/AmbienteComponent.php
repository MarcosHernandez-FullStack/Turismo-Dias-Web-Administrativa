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
    public $ambiente,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1,$foto_principal_guardada,$foto_secundaria_guardada;
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
        $this->ambiente=new Ambiente();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
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

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
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
           $this->ambiente = new Ambiente();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->beneficios_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $ambientes=Ambiente::where('nombre', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        return view('livewire.ambiente.ambiente-component', compact('ambientes','ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto_principal && $this->ruta_foto_secundaria){
            $this->ambiente->ruta_foto_principal = $this->ruta_foto_principal->store('public/ambientes/principal');
            $this->ambiente->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/ambientes/secundaria');
        }
        $servicioCreado= new Ambiente();
        $servicioCreado=$this->ambiente;
        $servicioCreado->save();
        foreach($this->beneficios_collection as $ciudad)
        {
            $servicioCreado->ciudades()->attach($ciudad);
        }
        session()->flash('message', 'Ambiente registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA AGREGAR ELEMENTOS AL beneficio_collection
    public function addBeneficioCollection($beneficio_id){
        $ciudad=Ciudad::find($beneficio_id);
        $this->beneficios_collection->push($ciudad);
        $this->reset('beneficio_id');
    }

     //FUNCION PARA ELIMINAR ELEMENTOS DEL beneficio_collection
     public function deleteBeneficioCollection($indiceElemento){
        $this->beneficios_collection->pull($indiceElemento); // Elimina el elemento en el índice $indiceElemento y lo devuelve
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
        $ambiente = Ambiente::find($id);
        if($ambiente->estado == 1){
            $ambiente->update(['estado' => '0']);
        }else{
            $ambiente->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Ambiente actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->ambiente=Ambiente::find($id);
       /*  $this->ruta_foto_principal=$this->ambiente->ruta_foto_principal;
        $this->ruta_foto_secundaria=$this->ambiente->ruta_foto_secundaria; */
        $this->foto_principal_guardada = $this->ambiente->ruta_foto_principal;
        $this->foto_secundaria_guardada = $this->ambiente->ruta_foto_secundaria;
        $this->beneficio_id=-1;
       /*  $this->reset('ruta_foto_principal','ruta_foto_secundaria'); */
    }

    public function update(){
        /* if($this->ambiente->) */
       /*  if($this->ruta_foto_principal) 
            $this->ambiente->ruta_foto_principal = $this->ruta_foto_principal->store('public/ambientes/principal');
        else
            $this->ambiente->ruta_foto_principal=$this->ambiente->ruta_foto_principal;
        if($this->ruta_foto_secundaria) 
            $this->ambiente->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/ambientes/secundaria');
        else
            $this->ambiente->ruta_foto_secundaria=$this->ambiente->ruta_foto_secundaria; */

        $this->validate();
        if($this->ruta_foto_principal!=$this->ambiente->ruta_foto_principal) $this->ambiente->ruta_foto_principal = $this->ruta_foto_principal->store('public/ambientes/principal');
        if($this->ruta_foto_secundaria!=$this->ambiente->ruta_foto_secundaria) $this->ambiente->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/ambientes/principal');
        $this->ambiente->update();
        session()->flash('message', 'Ambiente actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function saveServicioBeneficio(){
        $ambiente=Ambiente::find($this->ambiente->id);
        $ciudad=Ciudad::find($this->beneficio_id);
        $ambiente->ciudades()->attach($ciudad);
    }


}
