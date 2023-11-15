<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LogoutComponent extends Component
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.logout-component');
    }

    
}
