<?php

namespace App\Http\Livewire\Faq;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Faq;
use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Collection;

class FaqComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $faq,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1,$foto_principal_guardada,$foto_secundaria_guardada;
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
        $this->faq=new Faq();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'faq.pregunta' => 'required',
           'faq.respuesta' => 'required',
           'faq.tipo' => 'required',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
         'faq.pregunta.required' => 'El nombre del faq es requerido',
         'faq.respuesta.required' => 'El tipo de faq es requerido',
         'faq.tipo.required' => 'La coordenada longitud es requerida',
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
           $this->faq = new Faq();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->beneficios_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $faqs=Faq::where('pregunta', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $ciudades=Ciudad::where('estado','=','1')->get();
        return view('livewire.faq.faq-component', compact('faqs','ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto_principal && $this->ruta_foto_secundaria){
            $this->faq->ruta_foto_principal = $this->ruta_foto_principal->store('public/faqs/principal');
            $this->faq->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/faqs/secundaria');
        }
        $servicioCreado= new Faq();
        $servicioCreado=$this->faq;
        $servicioCreado->save();
        foreach($this->beneficios_collection as $ciudad)
        {
            $servicioCreado->ciudades()->attach($ciudad);
        }
        session()->flash('message', 'Faq registrado con éxito');
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
        $faq = Faq::find($id);
        if($faq->estado == 1){
            $faq->update(['estado' => '0']);
        }else{
            $faq->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Faq actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->faq=Faq::find($id);
       /*  $this->ruta_foto_principal=$this->faq->ruta_foto_principal;
        $this->ruta_foto_secundaria=$this->faq->ruta_foto_secundaria; */
        $this->foto_principal_guardada = $this->faq->ruta_foto_principal;
        $this->foto_secundaria_guardada = $this->faq->ruta_foto_secundaria;
        $this->beneficio_id=-1;
       /*  $this->reset('ruta_foto_principal','ruta_foto_secundaria'); */
    }

    public function update(){
        /* if($this->faq->) */
       /*  if($this->ruta_foto_principal) 
            $this->faq->ruta_foto_principal = $this->ruta_foto_principal->store('public/faqs/principal');
        else
            $this->faq->ruta_foto_principal=$this->faq->ruta_foto_principal;
        if($this->ruta_foto_secundaria) 
            $this->faq->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/faqs/secundaria');
        else
            $this->faq->ruta_foto_secundaria=$this->faq->ruta_foto_secundaria; */

        $this->validate();
        if($this->ruta_foto_principal!=$this->faq->ruta_foto_principal) $this->faq->ruta_foto_principal = $this->ruta_foto_principal->store('public/faqs/principal');
        if($this->ruta_foto_secundaria!=$this->faq->ruta_foto_secundaria) $this->faq->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/faqs/principal');
        $this->faq->update();
        session()->flash('message', 'Faq actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function saveServicioBeneficio(){
        $faq=Faq::find($this->faq->id);
        $ciudad=Ciudad::find($this->beneficio_id);
        $faq->ciudades()->attach($ciudad);
    }


}
