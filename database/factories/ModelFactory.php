<?php

namespace Database\Factories;

use App\Models\Model as CameraModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelFactory extends Factory
{
    protected $model = CameraModel::class;

    public function definition()
    {
        return [
            'name'          => $this->faker->word,
            'camera_model'  => $this->faker->word,
            'aperture'      => $this->faker->randomFloat(1, 1, 22),
            'shutter_speed' => $this->faker->randomElement(['1/50', '1/100', '1/200']),
            'iso'           => $this->faker->numberBetween(100, 3200),
            'focal_length'  => $this->faker->randomElement(['35', '50', '85']),
            'price_wot'     => $this->faker->randomFloat(2, 200, 1000),
            'price'         => $this->faker->randomFloat(2, 300, 1500),
        ];
    }
}
