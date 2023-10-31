<?php

namespace App\Http\Livewire\Institucional;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Institucional;
use App\Models\Valor;
use Illuminate\Database\Eloquent\Collection;

class InstitucionalComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $institucional,$ruta_foto_principal,$ruta_foto_secundaria,$valores_collection,$valor_id=-1,$foto_principal_guardada,$foto_secundaria_guardada;
    public $descripcion;
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
        $this->institucional= Institucional::count() ? Institucional::first() : new Institucional();
        $this->valores_collection = $this->institucional->valores;
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'institucional.slogan_home' => 'required',
           'institucional.breve_historia' => 'required',
           'institucional.mision' => 'required',
           'institucional.vision' => 'required',
           'ruta_foto_principal' => (!$this->institucional->id)?'required|image|max:2048':'nullable|image|max:2048',
           'ruta_foto_secundaria' => (!$this->institucional->id)?'required|image|max:2048':'nullable|image|max:2048',
           'valores_collection.*.descripcion' => 'required',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
            'institucional.slogan_home.required' => 'El slogan es requerido',
            'institucional.breve_historia.required' => 'La breve historia es requerida',
            'institucional.mision.required' => 'La misión es requerida',
            'institucional.vision.required' => 'La visión es requerida',
            'ruta_foto_principal.required' => 'La foto principal es requerida',
            'ruta_foto_principal.image' => 'La foto principal debe ser una imagen',
            'ruta_foto_principal.max' => 'La foto principal debe pesar menos de 2MB',
            'ruta_foto_secundaria.required' => 'La foto secundaria es requerida',
            'ruta_foto_secundaria.image' => 'La foto secundaria debe ser una imagen',
            'ruta_foto_secundaria.max' => 'La foto secundaria debe pesar menos de 2MB',
            'valores_collection.*.descripcion.required' => 'La descripción es requerida',
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
           $this->institucional = new Institucional();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->valores_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        // $institucional=Institucional::first();
        $ciudades=Valor::where('estado','=','1')->get();
        return view('livewire.institucional.institucional-component', compact('ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto_principal && $this->ruta_foto_secundaria){
            $this->institucional->ruta_foto_principal = $this->ruta_foto_principal->store('public/institucionales/principal');
            $this->institucional->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/institucionales/secundaria');
        }
        $servicioCreado= new Institucional();
        $servicioCreado=$this->institucional;
        $servicioCreado->save();
        foreach($this->valores_collection as $ciudad)
        {
            $servicioCreado->ciudades()->attach($ciudad);
        }
        session()->flash('message', 'Institucional registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA AGREGAR ELEMENTOS AL beneficio_collection
    public function addValorCollection(){
        $this->validate([
            'descripcion' => 'required',
        ]);
        $this->valores_collection->push(new Valor(['descripcion' => $this->descripcion]));
        $this->reset('descripcion');
    }

     //FUNCION PARA ELIMINAR ELEMENTOS DEL beneficio_collection
     public function deleteValorCollection($indiceElemento){
        $this->valores_collection->pull($indiceElemento); // Elimina el elemento en el índice $indiceElemento y lo devuelve
    }

    public function imprimir()
    {
        dd($this->valores_collection->all());
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIO
    public function rediregirProyectos($servicio_id){
        return redirect()->route('proyectos', ['servicio_id' => $servicio_id]);
    }

    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        if($this->institucional->estado == 1){
            $this->institucional->update(['estado' => '0']);
        }else{
            $this->institucional->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Institucional actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->institucional=Institucional::find($id);
       /*  $this->ruta_foto_principal=$this->institucional->ruta_foto_principal;
        $this->ruta_foto_secundaria=$this->institucional->ruta_foto_secundaria; */
        $this->foto_principal_guardada = $this->institucional->ruta_foto_principal;
        $this->foto_secundaria_guardada = $this->institucional->ruta_foto_secundaria;
        $this->valor_id=-1;
       /*  $this->reset('ruta_foto_principal','ruta_foto_secundaria'); */
    }

    public function update(){
        /* if($this->institucional->) */
       /*  if($this->ruta_foto_principal) 
            $this->institucional->ruta_foto_principal = $this->ruta_foto_principal->store('public/institucionales/principal');
        else
            $this->institucional->ruta_foto_principal=$this->institucional->ruta_foto_principal;
        if($this->ruta_foto_secundaria) 
            $this->institucional->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/institucionales/secundaria');
        else
            $this->institucional->ruta_foto_secundaria=$this->institucional->ruta_foto_secundaria; */

        $this->validate();
        if($this->ruta_foto_principal){
            if($this->ruta_foto_principal!=$this->institucional->ruta_foto_principal) 
            $this->institucional->ruta_foto_principal = $this->ruta_foto_principal->store('public/institucionales/principal');
        }
        if($this->ruta_foto_secundaria){
            if($this->ruta_foto_secundaria!=$this->institucional->ruta_foto_secundaria) 
            $this->institucional->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/institucionales/secundaria');
        }
        if(!$this->institucional->id){
            $this->institucional->estado = '1';
        }
        $this->institucional->save();

        foreach($this->valores_collection as $valor){
            $valor->institucional_id = $this->institucional->id;
            $valor->estado = 1;
            $valor->save();
        }
        $valores = Valor::where('institucional_id', $this->institucional->id)->get();
        foreach($valores as $valor){
            if(!$this->valores_collection->contains($valor)){
                $valor->delete();
            }
        }

        session()->flash('message', 'Institucional actualizado con éxito');
        // $this->dispatchBrowserEvent('closeModal');
    }

    public function saveServicioValor(){
        $institucional=Institucional::find($this->institucional->id);
        $ciudad=Valor::find($this->valor_id);
        $institucional->ciudades()->attach($ciudad);
    }


}
