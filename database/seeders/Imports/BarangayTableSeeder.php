<?php

namespace Database\Seeders\Imports;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangay;

class BarangayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source_file = database_path() . '/imports/barangays.csv';

        $row = 0;
        if (($handle = fopen($source_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;

                if($row > 1)
                {
                    Barangay::firstOrCreate([
                        'code' => $data[0],
                        'name' => $data[1],
                        'district' => $data[2],
                        'shortcode' => $data[4]
                    ]);
                }
                
            }
            fclose($handle);
        }
    }
}
