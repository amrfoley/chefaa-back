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
        foreach(range(1, 60000) as $index)
        {
            try {
                DB::table('pharmacy_product')->insert(PharmacyProduct::factory()->make()->toArray());                
            } catch(\Exception $e) {
                continue;
            }
        }
    }
}
