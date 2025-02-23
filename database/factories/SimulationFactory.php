<?php

namespace Database\Factories;

use App\Models\Simulation;
use App\Models\PhotoType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulationFactory extends Factory
{
    protected $model = Simulation::class;

    public function definition()
    {
        return [
            'photo_type_id' => PhotoType::factory(),
            'user_id'       => User::factory(),
            // dominant_make reste null par défaut
        ];
    }
}
