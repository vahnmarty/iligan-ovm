<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;

class ManageBorrowers extends Component
{
    public function render()
    {
        return view('livewire.logistics.manage-borrowers')->layout('layouts.admin');
    }
}
