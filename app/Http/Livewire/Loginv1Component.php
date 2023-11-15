<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Loginv1Component extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected function rules(){
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    protected $messages = [
        'email.required' => 'El email es requerido.',
        'email.email' => 'El email debe ser un email valido.',
        'password.required' => 'La password es requerida.'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    
    public function render()
    {
        return view('livewire.loginv1-component')
        ->extends('layouts.loginv1')
        ->section('content');
    }

    public function login()
    {
        $validatedData = $this->validate();

        if ($this->remember) {
            $validatedData['remember'] = true;
        }

        if (auth()->attempt($validatedData)) {
            session()->flash('message', 'Te has logueado correctamente.');
            return redirect()->route('bienvenido');
        } else {
            session()->flash('message', 'Estas credenciales no coinciden con los registros.');
        }
    }
    
}
