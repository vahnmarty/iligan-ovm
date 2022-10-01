<?php

namespace App\Http\Livewire\Collections;

use Livewire\Component;
use App\Models\Person;

class CreateCollection extends Component
{
    public function render()
    {
        return view('livewire.collections.create-collection')->layout('layouts.admin');
    }

    
}
