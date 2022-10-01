<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;

class CreateBorrower extends Component
{
    public function render()
    {
        return view('livewire.logistics.create-borrower')->layout('layouts.admin');
    }
}
