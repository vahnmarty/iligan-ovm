<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registration = Product::firstOrCreate([
            'code' => 'registration_fee',
            'name' => 'Registration Fee',
        ]);

        $registration->prices()->firstOrCreate([
            'amount' => 200,
            'created_by' => 1,
        ]);

        $contribution = Product::firstOrCreate([
            'code' => 'contribution',
            'name' => 'Contribution',
        ]);

        $registration->prices()->firstOrCreate([
            'amount' => 0,
            'created_by' => 1,
        ]);
    }
}
