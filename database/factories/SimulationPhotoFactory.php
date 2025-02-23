<?php

namespace Database\Factories;

use App\Models\SimulationPhoto;
use App\Models\Simulation;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulationPhotoFactory extends Factory
{
    protected $model = SimulationPhoto::class;

    public function definition()
    {
        return [
            'simulation_id' => Simulation::factory(),
            'photo_id'      => Photo::factory(),
            'step'          => $this->faker->numberBetween(1, 3),
        ];
    }
}
