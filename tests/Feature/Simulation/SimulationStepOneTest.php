<?php
namespace Tests\Feature\Simulation;

use App\Models\User;
use App\Models\Simulation;
use App\Models\Photo;
use App\Models\PhotoType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationStepOneTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_step_one()
    {
        $user = User::factory()->create();
        $photoType = PhotoType::factory()->create();
        $simulation = Simulation::factory()->create([
            'user_id' => $user->id,
            'photo_type_id' => $photoType->id,
        ]);

        $response = $this->actingAs($user)->get(route('simulation.create-step-one', ['simulation' => $simulation]));

        $response->assertStatus(200);
        $response->assertViewIs('simulations.step');
    }

    public function test_user_can_post_step_one()
    {
        $user = User::factory()->create();
        $photoType = PhotoType::factory()->create();
        $simulation = Simulation::factory()->create([
            'user_id' => $user->id,
            'photo_type_id' => $photoType->id,
        ]);

        $photos = Photo::factory()->count(3)->create();

        $response = $this->actingAs($user)->post(route('simulation.post-step-one', ['simulation' => $simulation]), [
            'selectedPhotos' => $photos->pluck('id')->toArray(),
        ]);

        $response->assertRedirect(route('simulation.create-step-two', ['simulation' => $simulation]));
        $this->assertDatabaseHas('simulation_photos', [
            'simulation_id' => $simulation->id,
            'photo_id' => $photos->first()->id,
            'step' => 1,
        ]);
    }
}
