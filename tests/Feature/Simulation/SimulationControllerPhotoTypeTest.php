<?php

namespace Tests\Feature;

use App\Models\PhotoType;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationControllerPhotoTypeTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testIndexReturnsCorrectView()
    {
        $response = $this->get(route('simulation.index'));
        $response->assertStatus(200)
            ->assertViewIs('simulations.index');
    }

    public function testPhotoTypeReturnsViewWithPhotoTypes()
    {
        PhotoType::factory()->count(3)->create();
        $response = $this->get(route('simulation.photoType'));
        $response->assertStatus(200)
            ->assertViewIs('simulations.photoType')
            ->assertViewHas('photoTypes');
    }

    public function testPhotoTypeNotDisplayedIfInsufficientPhotos()
    {
        $photoType = PhotoType::factory()->create();
        foreach (['Canon', 'NIKON CORPORATION', 'SONY'] as $brand) {
            $photos = Photo::factory()->count(29)->create([
                'make' => $brand,
            ]);
            $photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());
        }
        $response = $this->get(route('simulation.photoType'));
        $response->assertStatus(200);
        $response->assertViewHas('photoTypes', function ($photoTypes) use ($photoType) {
            return !$photoTypes->contains($photoType);
        });
    }

    public function testPhotoTypeDisplayedIfSufficientPhotos()
    {
        $photoType = PhotoType::factory()->create();
        foreach (['Canon', 'NIKON CORPORATION', 'SONY'] as $brand) {
            $photos = Photo::factory()->count(30)->create([
                'make' => $brand,
            ]);
            $photoType->photoTypePhotos()->attach($photos->pluck('id')->toArray());
        }
        $response = $this->get(route('simulation.photoType'));
        $response->assertStatus(200);
        $response->assertViewHas('photoTypes', function ($photoTypes) use ($photoType) {
            return $photoTypes->contains($photoType);
        });
    }
}
