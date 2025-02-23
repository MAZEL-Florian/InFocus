<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\SimulationPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerFinalStepTest extends TestCase
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
            'photo_type_id'  => $this->photoType->id,
            'user_id'        => $this->user->id,
            'dominant_make'  => 'Canon',
        ]);

        $photosStep1 = Photo::factory()->count(3)->create([
            'make'         => 'Canon',
            'focal_length' => '50',
            'aperture'     => 'f/2.8',
        ]);
        $photosStep2 = Photo::factory()->count(3)->create([
            'make'         => 'Canon',
            'focal_length' => '50',
            'aperture'     => 'f/2.8',
        ]);
        $photosStep3 = Photo::factory()->count(3)->create([
            'make'         => 'Canon',
            'focal_length' => '50',
            'aperture'     => 'f/2.8',
        ]);

        $this->photoType->photoTypePhotos()->attach(array_merge(
            $photosStep1->pluck('id')->toArray(),
            $photosStep2->pluck('id')->toArray(),
            $photosStep3->pluck('id')->toArray()
        ));

        foreach ($photosStep1 as $photo) {
            SimulationPhoto::factory()->create([
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 1,
            ]);
        }
        foreach ($photosStep2 as $photo) {
            SimulationPhoto::factory()->create([
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 2,
            ]);
        }
        foreach ($photosStep3 as $photo) {
            SimulationPhoto::factory()->create([
                'simulation_id' => $this->simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 3,
            ]);
        }
    }

    public function testCreateFinalStepReturnsViewWithPacks()
    {
        $response = $this->get(route('simulation.create-final-step', ['simulation' => $this->simulation->uuid]));
        $response->assertStatus(200)
            ->assertViewIs('simulations.final-step')
            ->assertViewHas('packs');
    }

    public function testFinalStepPacksAreSortedByPrice()
    {
        $response = $this->get(route('simulation.create-final-step', ['simulation' => $this->simulation->uuid]));
        $response->assertStatus(200);
        $response->assertViewHas('packs', function ($packs) {
            $prices = $packs->pluck('price')->toArray();
            $sorted = $prices;
            sort($sorted);
            return $prices === $sorted;
        });
    }
}
