<?php

namespace App\Http\Livewire\Logistics;

use Livewire\Component;
use App\Models\Material;
use App\Models\Requisition;
use Auth;

class CreateRequest extends Component
{
    public $items = [];

    public $materials = [];

    public $selected = [];

    public $is_review = false;
    
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
        $this->items[$index]['material_name'] =  $material->name;

        $this->selected[] = $materialId;
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
    }

    public function next()
    {
        $this->is_review = true;
    }

    public function confirm()
    {
        $request = new Requisition;
        $request->control_number = mt_rand();
        $request->created_by = Auth::id();
        $request->save();

        if( count($this->items) )
        {
            foreach($this->items as $item)
            {
                if($item['material_id'])
                {
                    $request->items()->create([
                        'material_id' => $item['material_id'],
                        'quantity' => $item['quantity'],
                        'persons' => 'Vahn',
                        'date_start' => $item['date_start'],
                        'date_end' => $item['date_end'],
                    ]);
                }
                
            }
        }
    }
}
