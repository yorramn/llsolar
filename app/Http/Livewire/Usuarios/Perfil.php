<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;

class Perfil extends Component
{
    public $user;

    public function render()
    {
        $this->user = auth()->user();
        return view('livewire.usuarios.perfil');
    }

}
