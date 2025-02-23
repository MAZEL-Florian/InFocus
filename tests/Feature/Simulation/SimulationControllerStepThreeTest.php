<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\SimulationPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerStepThreeTest extends TestCase
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
        ]);

        $canonPhotos = Photo::factory()->count(3)->create(['make' => 'Canon']);
        $nikonPhotos = Photo::factory()->count(3)->create(['make' => 'NIKON CORPORATION']);
        $sonyPhotos  = Photo::factory()->count(3)->create(['make' => 'SONY']);
        $photosStep1 = $canonPhotos->merge($nikonPhotos)->merge($sonyPhotos);
        $this->photoType->photoTypePhotos()->attach($photosStep1->pluck('id')->toArray());
        foreach ($photosStep1 as $photo) {
            SimulationPhoto::factory()->create([
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 1,
            ]);
        }
        $photosStep2 = Photo::factory()->count(9)->create();
        $this->photoType->photoTypePhotos()->attach($photosStep2->pluck('id')->toArray());
        foreach ($photosStep2 as $photo) {
            SimulationPhoto::factory()->create([
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 2,
            ]);
        }
    }

    public function testCreateStepThreeReturnsViewWithPhotosGroups()
    {
        $aperture1 = Photo::factory()->count(3)->create([
            'aperture' => 'f/1.8',
            'make'     => 'Canon',
        ]);
        $aperture2 = Photo::factory()->count(3)->create([
            'aperture' => 'f/2.8',
            'make'     => 'NIKON CORPORATION',
        ]);
        $aperture3 = Photo::factory()->count(3)->create([
            'aperture' => 'f/4',
            'make'     => 'SONY',
        ]);
        $photos = $aperture1->merge($aperture2)->merge($aperture3);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());

        $response = $this->get(route('simulation.create-step-three', ['simulation' => $this->simulation->uuid]));
        $response->assertStatus(200)
            ->assertViewIs('simulations.step')
            ->assertViewHas('photosByGroups');
    }

    public function testPostStepThreeFailsWithoutSelectedPhotos()
    {
        $response = $this->post(route('simulation.post-step-three', ['simulation' => $this->simulation->uuid]), []);
        $response->assertRedirect('simulation/' . $this->simulation->uuid . '/step-three')
            ->assertSessionHasErrors();
    }

    public function testPostStepThreeCreatesSimulationPhotos()
    {
        $photos = Photo::factory()->count(3)->create();
        $photoIds = $photos->pluck('id')->toArray();
        $data = ['selectedPhotos' => $photoIds];

        $response = $this->post(route('simulation.post-step-three', ['simulation' => $this->simulation->uuid]), $data);
        $response->assertRedirect(route('simulation.create-final-step', ['simulation' => $this->simulation->uuid]));

        foreach ($photoIds as $photoId) {
            $this->assertDatabaseHas('simulation_photos', [
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photoId,
                'step'          => 3,
            ]);
        }
    }
}
