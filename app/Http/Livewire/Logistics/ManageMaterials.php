<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\Material;

class ManageMaterials extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.logistics.manage-materials')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMaterials();
    }

    public function getMaterials()
    {
        $this->data = Material::get();
    }
}
