<?php

namespace App\Http\Livewire;

use App\Models\Customer\Customer;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'customers' => Customer::all()
        ]);
    }
}
