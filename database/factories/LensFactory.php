<?php

namespace Database\Factories;

use App\Models\Lens;
use Illuminate\Database\Eloquent\Factories\Factory;

class LensFactory extends Factory
{
    protected $model = Lens::class;

    public function definition()
    {
        return [
            'name'         => $this->faker->word,
            'focal_length' => $this->faker->randomElement(['24-70', '70-200', '50']),
            'price_wot'    => $this->faker->randomFloat(2, 100, 500),
            'price'        => $this->faker->randomFloat(2, 200, 800),
        ];
    }
}
