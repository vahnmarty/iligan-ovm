<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tent = MaterialCategory::create([
            'name' => 'Tents'
        ]);

        $tent->items()->create([
            'ui_icon' => 'heroicon-o-home',
            'name' => 'Tent',
            'description' => '',
            'active' => true,
            'stock_available' => 6,
            'stock_onhand' => 6,
        ]);

        $chair = MaterialCategory::create([
            'name' => 'Chairs'
        ]);

        $chair->items()->create([
            'ui_icon' => 'bx-chair',
            'name' => 'Monoblock (White)',
            'description' => '',
            'active' => true,
            'stock_available' => 6,
            'stock_onhand' => 6,
        ]);

        $chair->items()->create([
            'ui_icon' => 'bx-chair',
            'name' => 'Monoblock (Red)',
            'description' => '',
            'active' => true,
            'stock_available' => 200,
            'stock_onhand' => 100,
        ]);


        $car = MaterialCategory::create([
            'name' => 'Car'
        ]);

        $car->items()->create([
            'ui_icon' => 'bx-car',
            'name' => 'Toyota Rush',
            'description' => 'KAK 4840',
            'active' => true,
            'stock_available' => 1,
            'stock_onhand' => 1,
        ]);

        $car->items()->create([
            'ui_icon' => 'bx-car',
            'name' => 'Nissan Urvan',
            'description' => 'GOV 123',
            'active' => true,
            'stock_available' => 1,
            'stock_onhand' => 1,
        ]);
    }
}
