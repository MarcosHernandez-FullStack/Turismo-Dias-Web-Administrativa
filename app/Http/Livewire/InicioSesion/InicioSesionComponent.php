<?php

namespace App\Http\Livewire\InicioSesion;

use Livewire\Component;

class InicioSesionComponent extends Component
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
        return view('livewire.inicio-sesion.inicio-sesion-component')
            ->extends('layouts.inicio-sesion')
            ->section('content');
    }
    public function login()
    {
        $validatedData = $this->validate();

        if ($this->remember) {
            $validatedData['remember'] = true;
        }

        if (auth()->attempt($validatedData)) {
            $this->dispatchBrowserEvent('success', ['mensaje' => 'Has iniciado sesión correctamente.']);
            return redirect()->route('bienvenido');
        } else {
            $this->dispatchBrowserEvent('error', ['mensaje' => 'El correo o la contraseña son incorrectos.']);
        }
    }
}
