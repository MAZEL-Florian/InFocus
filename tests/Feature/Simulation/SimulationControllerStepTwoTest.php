<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerStepTwoTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $photoType;
    protected $simulation;

    public function setUp(): void
    {
        parent::setUp();
        $this->user      = User::factory()->create();
        $this->actingAs($this->user);
        $this->photoType = PhotoType::factory()->create();
        $this->simulation = Simulation::factory()->create([
            'photo_type_id' => $this->photoType->id,
            'user_id'       => $this->user->id,
            'dominant_make' => null,
        ]);
    }

    public function testCreateStepTwoReturnsViewWithPhotosGroups()
    {
        $focal35 = Photo::factory()->count(3)->create([
            'focal_length' => '35/1',
            'make'         => 'Canon',
        ]);
        $focal50 = Photo::factory()->count(3)->create([
            'focal_length' => '50/1',
            'make'         => 'NIKON CORPORATION',
        ]);
        $focal85 = Photo::factory()->count(3)->create([
            'focal_length' => '85/1',
            'make'         => 'SONY',
        ]);
        $photos = $focal35->merge($focal50)->merge($focal85);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());

        $response = $this->get(route('simulation.create-step-two', ['simulation' => $this->simulation->uuid]));
        $response->assertStatus(200)
            ->assertViewIs('simulations.step')
            ->assertViewHas('photosByGroups');
    }

    public function testPostStepTwoFailsWithoutSelectedPhotos()
    {
        $response = $this->post(route('simulation.post-step-two', ['simulation' => $this->simulation->uuid]), []);
        $response->assertRedirect('simulation/' . $this->simulation->uuid . '/step-two')
            ->assertSessionHasErrors();
    }

    public function testPostStepTwoCreatesSimulationPhotos()
    {
        $focal35 = Photo::factory()->create([
            'focal_length' => '35/1',
            'make'         => 'Canon',
        ]);
        $focal50 = Photo::factory()->create([
            'focal_length' => '50/1',
            'make'         => 'NIKON CORPORATION',
        ]);
        $focal85 = Photo::factory()->create([
            'focal_length' => '85/1',
            'make'         => 'SONY',
        ]);
        $photos = collect([$focal35, $focal50, $focal85]);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());
        $photoIds = $photos->pluck('id')->toArray();

        $data = ['selectedPhotos' => $photoIds];
        $response = $this->post(route('simulation.post-step-two', ['simulation' => $this->simulation->uuid]), $data);
        $response->assertRedirect(route('simulation.create-step-three', ['simulation' => $this->simulation->uuid]));

        foreach ($photoIds as $photoId) {
            $this->assertDatabaseHas('simulation_photos', [
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photoId,
                'step'          => 2,
            ]);
        }
    }
}
