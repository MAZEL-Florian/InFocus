<?php
namespace Tests\Feature\Simulation;

use App\Models\User;
use App\Models\Simulation;
use App\Models\PhotoType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_simulation_index()
    {
        $response = $this->get(route('simulation.index'));
        $response->assertStatus(200);
        $response->assertViewIs('simulations.index');
    }

    public function test_user_can_create_simulation()
    {
        $user = User::factory()->create();
        $photoType = PhotoType::factory()->create();

        $response = $this->actingAs($user)->post(route('simulation.store'), [
            'photo_type_id' => $photoType->id,
        ]);

        $response->assertRedirect(route('simulation.create-step-one', ['simulation' => Simulation::first()]));
        $this->assertDatabaseHas('simulations', [
            'photo_type_id' => $photoType->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_cannot_create_simulation_without_photo_type()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('simulation.store'), []);

        $response->assertSessionHasErrors('photo_type_id');
    }
}
