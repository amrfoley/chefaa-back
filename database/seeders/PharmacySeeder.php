<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++) 
        {
            DB::table('pharmacies')->insert(Pharmacy::factory(200)->make()->toArray());
        }
    }
}
