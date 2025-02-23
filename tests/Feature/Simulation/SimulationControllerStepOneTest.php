<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\SimulationPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerStepOneTest extends TestCase
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
    }

    public function testCreateStepOneReturnsViewWithPhotosGrouped()
    {
        $canonPhotos = Photo::factory()->count(3)->create(['make' => 'Canon']);
        $nikonPhotos = Photo::factory()->count(3)->create(['make' => 'NIKON CORPORATION']);
        $sonyPhotos  = Photo::factory()->count(3)->create(['make' => 'SONY']);
        $photos = $canonPhotos->merge($nikonPhotos)->merge($sonyPhotos);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());

        $response = $this->get(route('simulation.create-step-one', ['simulation' => $this->simulation->uuid]));
        $response->assertStatus(200)
            ->assertViewIs('simulations.step')
            ->assertViewHas('photosByGroups')
            ->assertViewHas('photoType');
    }

    public function testPostStepOneFailsWithoutSelectedPhotos()
    {
        $response = $this->post(route('simulation.post-step-one', ['simulation' => $this->simulation->uuid]), []);
        $response->assertRedirect('simulation/' . $this->simulation->uuid . '/step-one')
            ->assertSessionHasErrors();
    }

    public function testCreateStepOneFailsIfSeriesIncomplete()
    {
        $canonPhotos = Photo::factory()->count(3)->create(['make' => 'Canon']);
        $nikonPhotos = Photo::factory()->count(3)->create(['make' => 'NIKON CORPORATION']);
        $sonyPhotos  = Photo::factory()->count(2)->create(['make' => 'SONY']);
        $photos = $canonPhotos->merge($nikonPhotos)->merge($sonyPhotos);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());

        $response = $this->get(route('simulation.create-step-one', ['simulation' => $this->simulation->uuid]));
        $response->assertRedirect();
        $response->assertSessionHasErrors('error');
    }

    public function testPostStepOneCreatesSimulationPhotos()
    {
        $canonPhoto = Photo::factory()->create(['make' => 'Canon']);
        $nikonPhoto = Photo::factory()->create(['make' => 'NIKON CORPORATION']);
        $sonyPhoto  = Photo::factory()->create(['make' => 'SONY']);
        $photos = collect([$canonPhoto, $nikonPhoto, $sonyPhoto]);
        $this->photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());
        $photoIds = $photos->pluck('id')->toArray();

        $data = ['selectedPhotos' => $photoIds];
        $response = $this->post(route('simulation.post-step-one', ['simulation' => $this->simulation->uuid]), $data);
        $response->assertRedirect(route('simulation.create-step-two', ['simulation' => $this->simulation->uuid]));

        foreach ($photoIds as $photoId) {
            $this->assertDatabaseHas('simulation_photos', [
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photoId,
                'step'          => 1,
            ]);
        }
    }
}
