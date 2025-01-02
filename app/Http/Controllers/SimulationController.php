<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoType;
use App\Models\Simulation;
use App\Models\SimulationPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('simulations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array(
            'photo_type_id' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/photoType')
                ->withErrors($validator);
        }
        $simulation = new Simulation;
        $simulation->photo_type_id = $request->photo_type_id;
        $simulation->user_id = Auth::user()->id;
        $simulation->save();
        // $photoType = PhotoType::select('name')
        //     ->where('id', '=', $request->photo_type_id)->get();


        return redirect()->route('simulation.create-step-one', ['simulation' => $simulation]);
        // return view('simulations.step-one', compact('simulation'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function photoType()
    {

        $photoTypes = PhotoType::all();

        return view('simulations.photoType', compact('photoTypes'));
    }

    public function photos()
    {

        $photoTypes = PhotoType::all();

        return view('simulations.photoType', compact('photoTypes'));
    }

    public function createStepOne(Request $request, Simulation $simulation)
    {
        $photos = Photo::select('photos.*')
            ->join('photo_type_photos', 'photos.id', '=', 'photo_type_photos.photo_id')
            ->join('photo_types', 'photo_type_photos.photo_type_id', '=', 'photo_types.id')
            ->where('photo_types.id', '=', $simulation->photo_type_id)
            ->get()
            ->groupBy('make');
        $selectedPhotos = [];
        $maxSeries = 3; // Nombre de séries
        $photosPerSeries = 3; // Nombre de photos par série

        for ($series = 0; $series < $maxSeries; $series++) {
            foreach ($photos as $make => $photoGroup) {
                $photoIndex = $series; // Une photo différente par série
                if (isset($photoGroup[$photoIndex])) {
                    $selectedPhotos[$series][] = $photoGroup[$photoIndex];
                }
            }
        }

        // Réorganiser pour s'assurer que chaque série contient exactement 3 photos
        foreach ($selectedPhotos as $index => $series) {
            $selectedPhotos[$index] = array_slice($series, 0, $photosPerSeries);
        }
        $photoType = $simulation->photoType;

        return view('simulations.step-one', [
            'photosByGroups' => $selectedPhotos,
            'simulation' => $simulation,
            'photoType' => $photoType,
        ]);
    }


    public function postStepOne(Request $request, Simulation $simulation)
    {
        $rules = [
            'selectedPhotos' => 'required|array',
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
                'photo_id' => $photo->id,
                'step' => 1
            ]);
        }

        // Transmettre les IDs des photos sélectionnées via la session
        session(['selectedPhotos' => $request->input('selectedPhotos')]);

        return redirect()->route('simulation.create-step-two', compact('simulation'));
    }


    public function createStepTwo(Request $request, Simulation $simulation)
    {
        $selectedPhotoIds = session('selectedPhotos', []);
    
        if (empty($selectedPhotoIds)) {
            return redirect()->route('simulation.create-step-one', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo sélectionnée.']);
        }
    
        $selectedPhotos = Photo::whereIn('id', $selectedPhotoIds)->get();
    
        $makeCounts = $selectedPhotos->groupBy('make')->map->count();
    
        $dominantMake = $makeCounts->sortDesc()->keys()->first();
    
        $photos = collect();
    
        if ($makeCounts->count() === 1 || $makeCounts[$dominantMake] > 1) {
            $photos = Photo::where('make', $dominantMake)
                ->whereHas('photoTypes', function ($query) use ($simulation) {
                    $query->where('photo_types.id', $simulation->photo_type_id);
                })
                ->orderBy('focal_length')
                ->get();
        } else {
            $photos = Photo::whereHas('photoTypes', function ($query) use ($simulation) {
                $query->where('photo_types.id', $simulation->photo_type_id);
            })
                ->orderBy('focal_length')
                ->get();
        }
    
        $selectedPhotos = [];
        $maxSeries = 3; 
        $photosPerSeries = 3; 
        $usedPhotoIds = [];
    
        if ($makeCounts->count() === 1 || $makeCounts[$dominantMake] > 1) {
            for ($series = 0; $series < $maxSeries; $series++) {
                $availablePhotos = $photos->reject(function ($photo) use ($usedPhotoIds) {
                    return in_array($photo->id, $usedPhotoIds);
                });
    
                foreach ($availablePhotos as $photo) {
                    if (count($selectedPhotos[$series] ?? []) < $photosPerSeries) {
                        $selectedPhotos[$series][] = $photo;
                        $usedPhotoIds[] = $photo->id;
                    }
    
                    if (count($selectedPhotos[$series] ?? []) >= $photosPerSeries) {
                        break;
                    }
                }
            }
        } else {
            $photosByMake = $photos->groupBy('make');
    
            for ($series = 0; $series < $maxSeries; $series++) {
                foreach ($makeCounts->sortDesc()->keys() as $make) {
                    $availablePhotos = $photosByMake[$make]->reject(function ($photo) use ($usedPhotoIds) {
                        return in_array($photo->id, $usedPhotoIds);
                    });
    
                    if ($availablePhotos->isNotEmpty()) {
                        $photo = $availablePhotos->first();
    
                        if (count($selectedPhotos[$series] ?? []) < $photosPerSeries) {
                            $selectedPhotos[$series][] = $photo;
                            $usedPhotoIds[] = $photo->id;
                        }
                    }
    
                    if (count($selectedPhotos[$series] ?? []) >= $photosPerSeries) {
                        break;
                    }
                }
            }
        }
    
        foreach ($selectedPhotos as $index => $series) {
            $selectedPhotos[$index] = array_slice($series, 0, $photosPerSeries);
        }
    
        $photosByGroups = $selectedPhotos;
        // dd($photosByGroups);
        return view('simulations.step-two', [
            'photosByGroups' => $photosByGroups,
            'simulation' => $simulation,
        ]);
    }
    
    public function postStepTwo(Request $request, Simulation $simulation)
    {
        // dd(request()->all());
        $rules = [
            'selectedPhotos' => 'required|array',
            'selectedPhotos.*' => 'exists:photos,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/' . $simulation->uuid . '/step-one')
                ->withErrors($validator);
        }

        $selectedPhotos = Photo::whereIn('id', $request->input('selectedPhotos'))->get();
        // dd($selectedPhotos);
        foreach ($selectedPhotos as $photo) {
            SimulationPhoto::create([
                'simulation_id' => $simulation->id,
                'photo_id' => $photo->id,
                'step' => 2
            ]);
        }

        // Transmettre les IDs des photos sélectionnées via la session
        session(['selectedPhotos' => $request->input('selectedPhotos')]);
        // dd(session());
        return redirect()->route('simulation.create-step-three', compact('simulation'));
    }


    public function createStepThree(Request $request, Simulation $simulation)
    {
        // 1) Récupérer les IDs des photos sélectionnées à l’étape 2
        $selectedPhotoIds = session('selectedPhotos', []);
        if (empty($selectedPhotoIds)) {
            return redirect()->route('simulation.create-step-two', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo sélectionnée pour l’étape 3.']);
        }
    
        // 2) Charger les photos sélectionnées
        $selectedPhotos = Photo::whereIn('id', $selectedPhotoIds)->get();
    
        // 3) Déterminer la marque dominante (comme étape 2)
        $makeCounts = $selectedPhotos->groupBy('make')->map->count();
        $dominantMake = $makeCounts->sortDesc()->keys()->first();
    
        // 4) Déterminer la focale dominante (si c’est votre logique)
        $focalCounts = $selectedPhotos->groupBy('focal_length')->map->count();
        $dominantFocal = $focalCounts->sortDesc()->keys()->first();
    
        // 5) Construire la requête des photos candidates
        //    - Filtrées par type de photo
        //    - Filtrées par la marque dominante
        //    - (Éventuellement) Filtrées par la focale dominante
        //    - Triées par 'aperture' (supposé existant en base)
        $photosQuery = Photo::whereHas('photoTypes', function ($query) use ($simulation) {
                $query->where('photo_types.id', $simulation->photo_type_id);
            })
            ->where('make', $dominantMake)
            // ->where('focal_length', $dominantFocal) // <-- à activer si vous limitez à la focale dominante
            ->orderBy('aperture');
    
        $photos = $photosQuery->get();
    
        // 6) Créer 3 séries de 3 photos, sans réutiliser la même photo
        //    et en veillant à ce que, pour chaque série, l'ouverture soit unique.
        $maxSeries = 3;
        $photosPerSeries = 3;
        $selectedPhotosBySeries = [];
        $usedPhotoIds = [];  // pour n'utiliser qu'une fois chaque photo
    
        for ($series = 0; $series < $maxSeries; $series++) {
            // Exclure les photos déjà utilisées TOUTES séries confondues
            $availablePhotos = $photos->reject(function ($photo) use ($usedPhotoIds) {
                return in_array($photo->id, $usedPhotoIds);
            });
    
            // On mémorise ici les ouvertures déjà choisies pour cette série
            $usedAperturesThisSeries = [];
    
            // Remplir la série courante (max 3 photos) avec des ouvertures distinctes
            foreach ($availablePhotos as $photo) {
                if (count($selectedPhotosBySeries[$series] ?? []) < $photosPerSeries) {
                    // Vérifier si l'ouverture est déjà utilisée dans cette série
                    $aperture = $photo->aperture; // Adaptez si votre champ se nomme autrement
                    if (! in_array($aperture, $usedAperturesThisSeries)) {
                        // OK, on l'ajoute à la série
                        $selectedPhotosBySeries[$series][] = $photo;
                        $usedPhotoIds[] = $photo->id;
                        $usedAperturesThisSeries[] = $aperture;
                    }
                } else {
                    // Série pleine
                    break;
                }
            }
        }
    
        // 7) S’assurer que chaque série fasse max 3 photos (au cas où)
        foreach ($selectedPhotosBySeries as $seriesIndex => $photoSet) {
            $selectedPhotosBySeries[$seriesIndex] = array_slice($photoSet, 0, $photosPerSeries);
        }
        dd($selectedPhotosBySeries);
        // 8) Retourner la vue step-three
        return view('simulations.step-three', [
            'photosByGroups' => $selectedPhotosBySeries,
            'simulation'     => $simulation,
        ]);
    }
    
    public function postStepThree(Request $request, Simulation $simulation)
{
    $rules = [
        'selectedPhotos' => 'required|array',
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
            'step'          => 3, // ou un autre indicateur
        ]);
    }

    // Stocker pour la suite
    session(['selectedPhotos' => $request->input('selectedPhotos')]);

    // Passer à l’étape suivante (ou un récap)…
    return redirect()->route('simulation.final-step', compact('simulation'));
}

}
