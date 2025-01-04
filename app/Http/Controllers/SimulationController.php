<?php

namespace App\Http\Controllers;

use App\Models\Lens;
use App\Models\Model;
use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\SimulationPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SimulationController extends Controller
{

    public function index()
    {
        return view('simulations.index');
    }

    public function photoType()
    {
        $photoTypes = PhotoType::all();
        return view('simulations.photoType', compact('photoTypes'));
    }

    public function store(Request $request)
    {
        $rules = ['photo_type_id' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/photoType')
                ->withErrors($validator);
        }

        $simulation = new Simulation;
        $simulation->photo_type_id = $request->photo_type_id;
        $simulation->user_id       = auth()->id();
        $simulation->save();

        return redirect()->route('simulation.create-step-one', ['simulation' => $simulation]);
    }

    // --------------------------------------------------------
    // Étape 1 : Colorimétrie
    // --------------------------------------------------------
    public function createStepOne(Request $request, Simulation $simulation)
    {
        $photos = Photo::select('photos.*')
            ->join('photo_type_photos', 'photos.id', '=', 'photo_type_photos.photo_id')
            ->join('photo_types', 'photo_type_photos.photo_type_id', '=', 'photo_types.id')
            ->where('photo_types.id', '=', $simulation->photo_type_id)
            ->get()
            ->groupBy('make');

        foreach ($photos as $make => $collection) {
            $photos[$make] = $collection->shuffle();
        }

        $selectedPhotos = [];
        $maxSeries      = 3;
        $photosPerSeries = 3;

        for ($series = 0; $series < $maxSeries; $series++) {
            foreach ($photos as $make => $photoGroup) {
                $photoIndex = $series;
                if (isset($photoGroup[$photoIndex])) {
                    $selectedPhotos[$series][] = $photoGroup[$photoIndex];
                }
            }
        }

        foreach ($selectedPhotos as $index => $series) {
            $selectedPhotos[$index] = array_slice($series, 0, $photosPerSeries);
        }

        $photoType = $simulation->photoType;
        return view('simulations.step-one', [
            'photosByGroups' => $selectedPhotos,
            'simulation'     => $simulation,
            'photoType'      => $photoType,
        ]);
    }

    public function postStepOne(Request $request, Simulation $simulation)
    {
        $rules = [
            'selectedPhotos'   => 'required|array',
            'selectedPhotos.*' => 'exists:photos,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/' . $simulation->uuid . '/step-one')
                ->withErrors($validator);
        }

        $selectedPhotos = Photo::whereIn('id', $request->input('selectedPhotos'))->get();
        foreach ($selectedPhotos as $photo) {
            SimulationPhoto::create([
                'simulation_id' => $simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 1,
            ]);
        }
        if (! $simulation->dominant_make) {
            $dominantMake = $this->findDominantMake($selectedPhotos);
            if ($dominantMake) {
                $simulation->dominant_make = $dominantMake;
                $simulation->save();
            }
        }

        return redirect()->route('simulation.create-step-two', compact('simulation'));
    }

    // --------------------------------------------------------
    // Étape 2 : Focale (+ éventuellement marque si déterminée)
    // --------------------------------------------------------
    public function createStepTwo(Request $request, Simulation $simulation)
    {

        $dominantMake = $simulation->dominant_make;

        if ($dominantMake) {
            $photos = Photo::where('make', $dominantMake)
                ->whereHas('photoTypes', function ($q) use ($simulation) {
                    $q->where('photo_types.id', $simulation->photo_type_id);
                })
                ->orderBy('focal_length')
                ->get()
                ->shuffle();

            $maxSeries      = 3;
            $photosPerSeries = 3;
            $selectedPhotos = [];
            $usedPhotoIds   = [];

            for ($series = 0; $series < $maxSeries; $series++) {
                $available = $photos->reject(fn($p) => in_array($p->id, $usedPhotoIds));
                foreach ($available as $photo) {
                    if (count($selectedPhotos[$series] ?? []) < $photosPerSeries) {
                        $selectedPhotos[$series][] = $photo;
                        $usedPhotoIds[] = $photo->id;
                    }
                }
            }

            return view('simulations.step-two', [
                'photosByGroups' => $selectedPhotos,
                'simulation'     => $simulation,
            ]);
        } else {
            $photos = Photo::whereHas('photoTypes', function ($q) use ($simulation) {
                $q->where('photo_types.id', $simulation->photo_type_id);
            })
                ->orderBy('focal_length')
                ->get();

            $grouped = $photos->groupBy('make');
            foreach ($grouped as $make => $col) {
                $grouped[$make] = $col->shuffle();
            }

            $selectedPhotos = [];
            $maxSeries      = 3;
            $photosPerSeries = 3;

            for ($series = 0; $series < $maxSeries; $series++) {
                foreach ($grouped as $make => $photoGroup) {
                    $photoIndex = $series;
                    if (isset($photoGroup[$photoIndex])) {
                        $selectedPhotos[$series][] = $photoGroup[$photoIndex];
                    }
                }
            }

            return view('simulations.step-two', [
                'photosByGroups' => $selectedPhotos,
                'simulation'     => $simulation,
            ]);
        }
    }

    public function postStepTwo(Request $request, Simulation $simulation)
    {
        $rules = [
            'selectedPhotos'   => 'required|array',
            'selectedPhotos.*' => 'exists:photos,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/' . $simulation->uuid . '/step-two')
                ->withErrors($validator);
        }

        $selectedPhotos = Photo::whereIn('id', $request->input('selectedPhotos'))->get();
        foreach ($selectedPhotos as $photo) {
            SimulationPhoto::create([
                'simulation_id' => $simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 2,
            ]);
        }

        if (! $simulation->dominant_make) {
            $photosStepOne = $this->getPhotosForStep($simulation, 1);
            $allPhotos = $photosStepOne->merge($selectedPhotos);
            $dominantMake = $this->findDominantMake($allPhotos);
            if ($dominantMake) {
                $simulation->dominant_make = $dominantMake;
                $simulation->save();
            }
        }

        return redirect()->route('simulation.create-step-three', compact('simulation'));
    }

    // --------------------------------------------------------
    // Étape 3 : Ouverture
    // --------------------------------------------------------
    public function createStepThree(Request $request, Simulation $simulation)
    {
        $photosStepTwo = $this->getPhotosForStep($simulation, 2);
        if ($photosStepTwo->isEmpty()) {
            return redirect()->route('simulation.create-step-two', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo sélectionnée pour l’étape 3.']);
        }

        $photosStepOne = $this->getPhotosForStep($simulation, 1);
        $allPhotos     = $photosStepOne->merge($photosStepTwo);
        $dominantMake  = $this->findDominantMake($allPhotos);
        if ($dominantMake) {
            $photos = Photo::whereHas('photoTypes', function ($q) use ($simulation) {
                $q->where('photo_types.id', $simulation->photo_type_id);
            })
                ->where('make', $dominantMake)
                ->orderBy('aperture')
                ->get()
                ->shuffle();

            $maxSeries = 3;
            $photosPerSeries = 3;
            $selectedPhotosBySeries = [];
            $usedPhotoIds = [];

            for ($series = 0; $series < $maxSeries; $series++) {
                $available = $photos->reject(fn($p) => in_array($p->id, $usedPhotoIds));
                $usedApertures = [];
                foreach ($available as $photo) {
                    if (count($selectedPhotosBySeries[$series] ?? []) < $photosPerSeries) {
                        $ap = $photo->aperture;
                        if (! in_array($ap, $usedApertures)) {
                            $selectedPhotosBySeries[$series][] = $photo;
                            $usedPhotoIds[] = $photo->id;
                            $usedApertures[] = $ap;
                        }
                    }
                }
            }

            return view('simulations.step-three', [
                'photosByGroups' => $selectedPhotosBySeries,
                'simulation'     => $simulation,
            ]);
        } else {
            $photosAll = Photo::whereHas('photoTypes', function ($q) use ($simulation) {
                $q->where('photo_types.id', $simulation->photo_type_id);
            })
                ->orderBy('aperture')
                ->get();

            $grouped = $photosAll->groupBy('make');
            foreach ($grouped as $make => $col) {
                $grouped[$make] = $col->shuffle();
            }

            $maxSeries = 3;
            $photosPerSeries = 3;
            $selectedPhotosBySeries = [];

            for ($series = 0; $series < $maxSeries; $series++) {
                foreach ($grouped as $make => $photoGroup) {
                    $photoIndex = $series;
                    if (isset($photoGroup[$photoIndex])) {
                        $selectedPhotosBySeries[$series][] = $photoGroup[$photoIndex];
                    }
                }
            }

            return view('simulations.step-three', [
                'photosByGroups' => $selectedPhotosBySeries,
                'simulation'     => $simulation,
            ]);
        }
    }

    public function postStepThree(Request $request, Simulation $simulation)
    {
        $rules = [
            'selectedPhotos'   => 'required|array',
            'selectedPhotos.*' => 'exists:photos,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/' . $simulation->uuid . '/step-three')
                ->withErrors($validator);
        }

        $selectedPhotos = Photo::whereIn('id', $request->input('selectedPhotos'))->get();
        foreach ($selectedPhotos as $photo) {
            SimulationPhoto::create([
                'simulation_id' => $simulation->id,
                'photo_id'      => $photo->id,
                'step'          => 3,
            ]);
        }
        if (! $simulation->dominant_make) {
            $photosStepOne   = $this->getPhotosForStep($simulation, 1);
            $photosStepTwo   = $this->getPhotosForStep($simulation, 2);
            $allPhotos       = $photosStepOne->merge($photosStepTwo)->merge($selectedPhotos);

            $dominantMake = $this->findDominantMake($allPhotos);
            if ($dominantMake) {
                $simulation->dominant_make = $dominantMake;
                $simulation->save();
            }
        }

        return redirect()->route('simulation.create-final-step', compact('simulation'));
    }

    // --------------------------------------------------------
    // Étape Finale
    // --------------------------------------------------------
    public function createFinalStep(Request $request, Simulation $simulation)
    {
        $photosStepOne   = $this->getPhotosForStep($simulation, 1);
        $photosStepTwo   = $this->getPhotosForStep($simulation, 2);
        $photosStepThree = $this->getPhotosForStep($simulation, 3);

        if ($photosStepOne->isEmpty()) {
            return redirect()->route('simulation.create-step-one', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 1).']);
        }
        if ($photosStepTwo->isEmpty()) {
            return redirect()->route('simulation.create-step-two', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 2).']);
        }
        if ($photosStepThree->isEmpty()) {
            return redirect()->route('simulation.create-step-three', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 3).']);
        }

        $dominantMake = $simulation->dominant_make;
        $focalValues = $photosStepTwo->map(function ($p) {
            if (strpos($p->focal_length, '/') !== false) {
                [$num, $den] = explode('/', $p->focal_length);
                return $num / $den;
            }
            return (float) $p->focal_length;
        });
        $focalCounts = $focalValues->countBy();
        $topFocalValues = $focalCounts->sortDesc()->keys()->take(3);
        while ($topFocalValues->count() < 3 && $topFocalValues->count() > 0) {
            $topFocalValues->push($topFocalValues->first());
        }

        $apertureValues = $photosStepThree->map(function ($p) {
            $apStr = str_replace('f/', '', $p->aperture);
            return (float) $apStr;
        });
        $apertureCounts = $apertureValues->countBy();
        $topApertureValues = $apertureCounts->sortDesc()->keys()->take(3);
        while ($topApertureValues->count() < 3 && $topApertureValues->count() > 0) {
            $topApertureValues->push($topApertureValues->first());
        }

        $camerasQuery = Model::query();
        if ($dominantMake) {
            $camerasQuery->where('brand', $dominantMake);
        }
        $cameras = $camerasQuery->take(10)->get();

        $lensesAll = Lens::all();

        $packs      = collect();
        $usedCombos = [];
        $cameraUsed = [];
        $lensUsed   = [];

        for ($i = 0; $i < 3; $i++) {
            $focal    = $topFocalValues[$i];
            $aperture = $topApertureValues[$i];

            $attempts     = 0;
            $maxAttempts  = 8;
            $packCamera   = null;
            $packLens     = null;
            $foundPack    = false;

            while (! $foundPack && $attempts < $maxAttempts) {
                $attempts++;
                $camera = $this->pickCamera($cameras, $cameraUsed);
                if (! $camera && $cameras->count()) {
                    $camera = $cameras->random();
                }
                if (! $camera) {
                    break;
                }
                $lens = $this->findLensFor($focal, $aperture, $dominantMake, $lensUsed);
                if (! $lens) {
                    $lens = $this->findLensFor($focal, $aperture, null, $lensUsed);
                }
                if (! $lens && $lensesAll->count()) {
                    $lens = $lensesAll->random();
                }
                if (! $lens) {
                    continue;
                }
                $sharedMounts = $camera->mounts->intersect($lens->mounts);
                if ($sharedMounts->isEmpty()) {
                    continue;
                }
                $comboKey = $camera->id . '_' . $lens->id;
                if (in_array($comboKey, $usedCombos)) {
                    continue;
                }
                $packCamera = $camera;
                $packLens   = $lens;
                $foundPack  = true;

                $usedCombos[] = $comboKey;
                $cameraUsed[] = $camera->id;
                $lensUsed[]  = $lens->id;
            }

            if (! $foundPack) {
                $packCamera = $cameras->get($i) ?? ($cameras->count() ? $cameras->random() : null);
                $packLens   = $lensesAll->get($i) ?? ($lensesAll->count() ? $lensesAll->random() : null);
                if (! $packCamera || ! $packLens) {
                    break;
                }
                $comboKey = $packCamera->id . '_' . $packLens->id;
                if (! in_array($comboKey, $usedCombos)) {
                    $usedCombos[] = $comboKey;
                }
            }

            $totalPrice = (float)$packCamera->price + (float)$packLens->price;
            $monthly   = round($totalPrice / 36, 2);

            $packs->push([
                'title' => 'temp',
                'camera' => $packCamera,
                'lens' => $packLens,
                'focalRequested' => $focal,
                'apertureWanted' => $aperture,
                'price' => $monthly,
            ]);
        }
        $packs = $packs->sortBy('price')->values();

        $packs = $packs->map(function ($pack, $index) {
            $newTitle = match ($index) {
                0 => 'Pack Essentiel',
                1 => 'Pack Recommandé',
                2 => 'Pack Premium',
                default => 'Pack #'.($index+1),
            };
            $pack['title'] = $newTitle;
        
            return $pack;
        });
        return view('simulations.final-step', [
            'simulation' => $simulation,
            'packs' => $packs,
        ]);
    }

    // -----------------------------------------------------------------
    // HELPERS
    // -----------------------------------------------------------------

    private function findDominantMake($photos)
    {
        if ($photos->isEmpty()) {
            return null;
        }

        $makeCounts = $photos->groupBy('make')->map->count();
        $sorted = $makeCounts->sortDesc();

        $dominant = $sorted->keys()->first();
        $dominantCount = $sorted->values()->first();

        $secondCount = $sorted->values()->skip(1)->first() ?? 0;

        if ($dominantCount > $secondCount) {
            return $dominant;
        }

        return null;
    }

    private function getPhotosForStep(Simulation $simulation, int $step)
    {
        return Photo::select('photos.*')
            ->join('simulation_photos', 'simulation_photos.photo_id', '=', 'photos.id')
            ->where('simulation_photos.simulation_id', $simulation->id)
            ->where('simulation_photos.step', $step)
            ->get();
    }

    private function pickCamera($cameras, array $cameraUsed)
    {
        $newOne = $cameras->first(fn($cam) => ! in_array($cam->id, $cameraUsed));
        return $newOne ?: null;
    }

    private function findLensFor(float $focal, float $aperture, ?string $dominantMake, array $lensUsed)
    {
        $query = Lens::query()
            ->whereNotIn('id', $lensUsed)
            ->where('min_focal_length', '<=', $focal)
            ->where('max_focal_length', '>=', $focal)
            ->where('min_aperture', '<=', $aperture)
            ->where('max_aperture', '>=', $aperture);

        if ($dominantMake) {
            $query->where('brand', $dominantMake);
        }
        $candidate = $query->first();
        if ($candidate) {
            return $candidate;
        }

        $fallback = Lens::query()->whereNotIn('id', $lensUsed);
        if ($dominantMake) {
            $fallback->where('brand', $dominantMake);
        }
        $candidate = $fallback
            ->orderByRaw("ABS(((min_focal_length+max_focal_length)/2 - ?))", [$focal])
            ->first();
        return $candidate;
    }
}
