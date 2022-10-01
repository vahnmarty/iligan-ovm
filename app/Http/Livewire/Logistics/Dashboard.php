<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\RequisitionItem;

class Dashboard extends Component
{
    public $today_widgets = [1,2,3,4];
    
    public function render()
    {
        return view('livewire.logistics.dashboard')->layout('layouts.kiosk');
    }

    public function mount()
    {
        $this->getTodayMaterials();
    }

    public function getTodayMaterials()
    {
        $this->today_widgets = RequisitionItem::with('material', 'parent')->get();
    }
}
