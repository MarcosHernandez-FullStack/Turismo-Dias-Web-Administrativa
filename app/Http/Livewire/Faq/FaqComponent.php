<?php

namespace App\Http\Livewire\Faq;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $faq;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    public function mount(){
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create';
        $this->vista = 'form'; 
        $this->faq=new Faq();
    }

     public function updatingSearch(){
        $this->resetPage();
    }

    protected function rules(){
        return [
           'faq.pregunta' => 'required|max:120',
           'faq.respuesta' => 'required|max:255',
           'faq.tipo' => 'required',
        ];
   }

   protected $messages = [
         'faq.pregunta.required' => 'El nombre del faq es requerido',
         'faq.pregunta.max' => 'El nombre del faq debe contener como máximo 120 caracteres',
         'faq.respuesta.required' => 'El tipo de faq es requerido',
         'faq.respuesta.max' => 'El tipo de faq debe contener como máximo 255 caracteres',
         'faq.tipo.required' => 'La coordenada longitud es requerida',
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
           $this->faq = new Faq();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render(){
        $faqs=Faq::where('pregunta', 'like', '%'.$this->search.'%')
        ->orWhere('respuesta', 'like', '%'.$this->search.'%')   
        ->paginate($this->paginacion);
        return view('livewire.faq.faq-component', compact('faqs'))
                ->extends('layouts.principal')
                ->section('content');
    }

    public function save(){
        $this->validate();
        $this->faq->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }

    public function cambiarEstado($id){
        $faq = Faq::find($id);
        if($faq->estado == 1){
            $faq->update(['estado' => '0']);
        }else{
            $faq->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Faq actualizado con éxito');
    }

    public function edit($id){
        $this->showModal("form", "update");
        $this->faq=Faq::find($id);
    }

    public function update(){
        $this->validate();
        $this->faq->update();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
    }
}
