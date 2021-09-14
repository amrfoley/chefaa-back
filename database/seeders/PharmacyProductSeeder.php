<?php

namespace Database\Seeders;

use App\Models\PharmacyProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 400; $i++)
        {
            try {
                DB::table('pharmacy_product')->insert(PharmacyProduct::factory(200)->make()->toArray());                
            } catch(\Exception $e) {
                continue;
            }
        }
    }
}
