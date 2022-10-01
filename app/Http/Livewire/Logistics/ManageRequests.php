<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\Requisition;

class ManageRequests extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.logistics.manage-requests')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMaterials();
    }

    public function getMaterials()
    {
        $this->data = Requisition::get();
    }
}
