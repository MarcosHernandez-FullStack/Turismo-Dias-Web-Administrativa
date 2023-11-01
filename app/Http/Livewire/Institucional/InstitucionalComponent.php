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
    public $institucional,$ruta_foto_principal,$ruta_foto_secundaria,$valores_collection,$valor_id=-1;
    public $descripcion;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    public function mount(){
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->institucional= Institucional::count() ? Institucional::first() : new Institucional();
        $this->valores_collection = $this->institucional->valores;
    }

     public function updatingSearch(){
        $this->resetPage();
    }

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
           $this->institucional = new Institucional();
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->valores_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render(){
        $ciudades=Valor::where('estado','=','1')->get();
        return view('livewire.institucional.institucional-component', compact('ciudades'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function addValorCollection(){
        $this->validate([
            'descripcion' => 'required',
        ]);
        $this->valores_collection->push(new Valor(['descripcion' => $this->descripcion]));
        $this->reset('descripcion');
    }

     public function deleteValorCollection($indiceElemento){
        $this->valores_collection->pull($indiceElemento);
    }

    public function cambiarEstado($id){
        if($this->institucional->estado == 1){
            $this->institucional->update(['estado' => '0']);
        }else{
            $this->institucional->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Institucional actualizado con éxito');  
    }

    public function update(){
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
    }

    public function saveServicioValor(){
        $institucional=Institucional::find($this->institucional->id);
        $ciudad=Valor::find($this->valor_id);
        $institucional->ciudades()->attach($ciudad);
    }


}
