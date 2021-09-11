<?php

namespace Database\Factories;

use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pharmacy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->text(80),
            'code'      => Str::random(12),
            'address'   => $this->faker->address()
        ];
    }
}
