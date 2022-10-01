<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\RequisitionItem;

class Dashboard extends Component
{
    public $today_widgets = [], $tomorrow_widgets = [];
    
    public function render()
    {
        $this->getTodayMaterials();
        $this->getTomorrowMaterials();

        return view('livewire.logistics.dashboard')->layout('layouts.kiosk');
    }

    public function mount()
    {
        
    }

    public function getTodayMaterials()
    {
        $this->today_widgets = RequisitionItem::with('material', 'parent')->whereDate('date_start', date('Y-m-d'))->get();
    }

    public function getTomorrowMaterials()
    {
        $this->tomorrow_widgets = RequisitionItem::with('material', 'parent')->whereDate('date_start', date('Y-m-d', strtotime('+1 day')))->get();
    }
}
