<?php

namespace App\Http\Livewire\TipoBus;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\TipoBus;
use Livewire\WithFileUploads;

class TipoBusComponent extends Component
{
    use WithFileUploads;
    public $tipoBus, $ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;


    public function mount()
    {
        $this->sort = 'id';
        $this->direction = 'asc';
        $this->form = 'create';
        $this->vista = 'form';
        $this->tipoBus = new TipoBus();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'tipoBus.nombre' => 'required|max:20',
            'tipoBus.descripcion' => 'required|max:120',
            'ruta_foto' => 'nullable',
        ];
    }

    protected $messages = [
        'tipoBus.nombre.required' => 'El nombre del Tipo de Bus es obligatorio.',
        'tipoBus.descripcion.required' => 'La descripción del Tipo de Bus es obligatoria.',
        'ruta_foto.required' => 'La foto para el Tipo de Bus es obligatoria.',
        'tipoBus.nombre.max' => 'El nombre del Tipo de Bus debe tener un máximo de 20 caracteres.',
        'tipoBus.descripcion.max' => 'La descripción del Tipo de Bus debe tener un máximo de 120 caracteres.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetError()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function showModal($vista, $form)
    {
        $this->resetError();
        if ($form == 'create') {
            $this->tipoBus = new TipoBus();
        }
        $this->vista = $vista;
        $this->form = $form;
        $this->dispatchBrowserEvent('showModalTipoBus');
    }

    public function render()
    {
        $tipobuses=TipoBus::where('estado','=','1')->get();
        return view('livewire.tipo-bus.tipo-bus-component',compact('tipobuses'));
    }

    public function save()
    {
        $this->validate();
        if ($this->ruta_foto) {
            if ($this->ruta_foto != $this->tipoBus->ruta_foto) {
                if (Storage::exists($this->tipoBus->ruta_foto)) {
                    Storage::delete($this->tipoBus->ruta_foto);
                }
                $this->tipoBus->ruta_foto = $this->ruta_foto->store('public/tipoBus');
            }
        }
        $this->tipoBus->save();
        $this->dispatchBrowserEvent('closeModalTipoBus');
        $this->dispatchBrowserEvent('success', ['mensaje' => 'El registro se ha guardado correctamente!']);
        $this->ruta_foto=null;
    }

    public function edit($id)
    {
        $this->showModal("form", "update");
        $this->tipoBus = TipoBus::find($id);
    }

}
