<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\ProductPharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'    => Product::cursor()->random()->id,
            'pharmacy_id'   => Pharmacy::cursor()->random()->id,
            'price'         => $this->faker->randomFloat(2, 5, 1000),
            'quantity'      => $this->faker->randomNumber(4, false),
            'status'        => $this->faker->numberBetween(0, 1),
        ];
    }
}
