<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\Material;

class CreateRequest extends Component
{
    public $items = [];

    public $materials = [];

    public $selected = [];
    
    public function render()
    {
        return view('livewire.logistics.create-request')->layout('layouts.admin');
    }

    public function mount()
    {
        $this->getMaterials();

        $this->addItem();
    }

    public function getMaterials()
    {
        $this->materials = Material::get();
    }

    public function addItem()
    {
        $this->items[] = [
            'material_id' => null,
            'name' => null,
            'stock_available' => null,
            'quantity' => null,
        ];
    }

    public function selectMaterial($index)
    {
        $materialId = $this->items[$index]['material_id'];
        $material = Material::find($materialId);

        $this->items[$index]['stock_available'] =  $material->stock_available;

        $this->selected[] = $materialId;
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
    }
}
