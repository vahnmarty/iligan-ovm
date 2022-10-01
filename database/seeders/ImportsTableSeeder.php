<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Imports\PuroksTableSeeder;
use Database\Seeders\Imports\BarangayTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BarangayTableSeeder::class);
        $this->call(PuroksTableSeeder::class);
    }
}
