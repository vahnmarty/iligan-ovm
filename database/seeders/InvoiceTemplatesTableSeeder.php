<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\InvoiceTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvoiceTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRegistration();
        $this->createTopup();
    }

    public function createRegistration()
    {
        $template = InvoiceTemplate::firstOrCreate([
            'code' => 'registration'
        ]);

        $products = Product::whereIn('code', ['registration_fee', 'contribution'])->get();

        foreach($products as $product)
        {
            $template->items()->firstOrCreate([
                'product_id' => $product->id
            ]);
        }
    }

    public function createTopup()
    {
        $template = InvoiceTemplate::firstOrCreate([
            'code' => 'topup'
        ]);

        $products = Product::whereIn('code', ['contribution'])->get();

        foreach($products as $product)
        {
            $template->items()->firstOrCreate([
                'product_id' => $product->id
            ]);
        }
    }
}
