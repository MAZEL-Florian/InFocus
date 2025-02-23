<?php

namespace Tests\Feature;

use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testStoreFailsWithoutPhotoTypeId()
    {
        $response = $this->post(route('simulation.store'), []);
        $response->assertRedirect('simulation/photoType')
            ->assertSessionHasErrors();
    }

    public function testStoreCreatesSimulationAndRedirects()
    {
        $photoType = PhotoType::factory()->create();
        $data = ['photo_type_id' => $photoType->id];
        $response = $this->post(route('simulation.store'), $data);
        $response->assertRedirect();

        $this->assertDatabaseHas('simulations', [
            'photo_type_id' => $photoType->id,
            'user_id'       => $this->user->id,
        ]);
    }
}
