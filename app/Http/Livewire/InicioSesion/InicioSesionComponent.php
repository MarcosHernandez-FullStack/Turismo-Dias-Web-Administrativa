<?php

namespace App\Http\Livewire\InicioSesion;

use Livewire\Component;

class InicioSesionComponent extends Component
{
    public function render()
    {
        return view('livewire.inicio-sesion.inicio-sesion-component')
            ->extends('layouts.inicio-sesion')
            ->section('content');
    }
}
