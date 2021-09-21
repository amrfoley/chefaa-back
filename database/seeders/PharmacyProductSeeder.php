<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PharmacyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Pharmacy::cursor()->random(10000) as $pharmacy)
        {
            $products = Product::cursor()->random(random_int(0, 50))->pluck('id')->toArray();
            $pharmacy->products()->attach($products, [
                'price'         => random_int(1000, 99999) / 100,
                'quantity'      => random_int(0, 200),
                'status'        => random_int(0, 1),
            ]);                
        }
    }
}
