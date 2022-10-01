<?php

namespace Database\Seeders\Imports;

use App\Models\Barangay;
use App\Models\Purok;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PuroksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source_file = database_path() . '/imports/puroks.csv';

        $row = 0;
        if (($handle = fopen($source_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;

                if($row > 1)
                {
                    $brgy = Barangay::where('code',$data[1])->first();

                    if($brgy)
                    {
                        Purok::firstOrCreate([
                            'barangay_id' => $brgy->id,
                            'barangay' => $brgy->name,
                            'name' => $data[2],
                        ]);
                    }
                    
                }
                
            }
            fclose($handle);
        }
    }
}
