<?php

namespace App\Http\Controllers;

use App\Models\Lens;
use App\Models\Model;
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
        session(['selectedPhotosStepOne' => $request->input('selectedPhotos')]);

        return redirect()->route('simulation.create-step-two', compact('simulation'));
    }


    public function createStepTwo(Request $request, Simulation $simulation)
    {
        $selectedPhotoIds = session('selectedPhotosStepOne', []);

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
        session(['selectedPhotosStepTwo' => $request->input('selectedPhotos')]);
        // dd(session());
        return redirect()->route('simulation.create-step-three', compact('simulation'));
    }


    public function createStepThree(Request $request, Simulation $simulation)
    {
        // 1) Récupérer les IDs des photos sélectionnées à l’étape 2
        $selectedPhotoIds = session('selectedPhotosStepTwo', []);
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
        // dd($photos);
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
        // dd($selectedPhotosBySeries);
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
                'step'          => 3,
            ]);
        }

        session(['selectedPhotosStepThree' => $request->input('selectedPhotos')]);

        return redirect()->route('simulation.create-final-step', compact('simulation'));
    }

    public function createFinalStep(Request $request, Simulation $simulation)
    {
        // 1) Récupération des IDs de chaque étape
        $selectedPhotoIdsStepOne   = session('selectedPhotosStepOne', []);
        $selectedPhotoIdsStepTwo   = session('selectedPhotosStepTwo', []);
        $selectedPhotoIdsStepThree = session('selectedPhotosStepThree', []);

        // 2) Vérifier qu'on a bien des sélections pour chaque étape
        if (empty($selectedPhotoIdsStepOne)) {
            return redirect()
                ->route('simulation.create-step-one', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 1).']);
        }
        if (empty($selectedPhotoIdsStepTwo)) {
            return redirect()
                ->route('simulation.create-step-two', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 2).']);
        }
        if (empty($selectedPhotoIdsStepThree)) {
            return redirect()
                ->route('simulation.create-step-three', compact('simulation'))
                ->withErrors(['error' => 'Aucune photo (étape 3).']);
        }

        // 3) Charger les photos de chaque étape
        $photosStepOne   = Photo::whereIn('id', $selectedPhotoIdsStepOne)->get();
        $photosStepTwo   = Photo::whereIn('id', $selectedPhotoIdsStepTwo)->get();
        $photosStepThree = Photo::whereIn('id', $selectedPhotoIdsStepThree)->get();

        // ----------------------------------------------------
        // Étape 1 : Marque dominante (colorimétrie)
        // ----------------------------------------------------
        $makeCounts   = $photosStepOne->groupBy('make')->map->count();
        $dominantMake = $makeCounts->sortDesc()->keys()->first();  // ex. "Canon"

        // ----------------------------------------------------
        // Étape 2 : Extraire jusqu’à 3 focales “dominantes”
        // ----------------------------------------------------
        $focalValuesStepTwo = $photosStepTwo->map(function ($photo) {
            if (strpos($photo->focal_length, '/') !== false) {
                [$num, $den] = explode('/', $photo->focal_length);
                return $num / $den; // ex. "30/1" => 30.0
            }
            return (float) $photo->focal_length;
        });
        $focalCounts     = $focalValuesStepTwo->countBy(); 
        $topFocalValues  = $focalCounts->sortDesc()->keys()->take(3); 
        // ex. s’il y a 2 focales => on aura 2
        
        // S’il n’y a qu’une ou deux focales, on duplique 
        // pour être sûr d’en avoir 3 (si possible)
        while ($topFocalValues->count() < 3 && $topFocalValues->count() > 0) {
            // Dupliquer la plus fréquente (qui est en premier)
            $focalToDuplicate = $topFocalValues->first();
            $topFocalValues->push($focalToDuplicate);
        }
        // ex. [10, 17, 300] si l’utilisateur a choisi 10, 17, 300
        // dd($focalValuesStepTwo);
        // ----------------------------------------------------
        // Récupérer la liste des boîtiers "dominantMake"
        // ----------------------------------------------------
        // On en prend plus que 3, au cas où on manquerait. On pourra piocher dedans.
        $cameras = Model::where('brand', $dominantMake)->take(10)->get();

        // ----------------------------------------------------
        // Générer 3 packs (1 par focale),
        // en réutilisant le matos si on n’a pas assez de choix distincts
        // ----------------------------------------------------
        $packs = collect();
        $cameraUsed    = []; // pour éviter la duplication inutile si on a assez de boîtiers
        $lensUsed      = []; // idem pour les objectifs

        $focaleIndex = 0; // On avance dans topFocalValues
        $packCount   = 0; // Combien de packs créés

        while ($packCount < 3 && $focaleIndex < $topFocalValues->count()) {
            $focal = $topFocalValues[$focaleIndex];

            // Étape A) Chercher un boîtier (priorité à un boîtier qu’on n’a pas encore utilisé)
            $camera = $this->pickCamera($cameras, $cameraUsed);
            if (! $camera) {
                // plus de boîtiers disponibles, on tente la réutilisation forcée
                $camera = $cameras->first();
                if (! $camera) {
                    // Aucune caméra en base => impossible de poursuivre
                    break;
                }
            }

            // Étape B) Chercher un objectif pour cette focale
            $lens = $this->findLensForFocal($focal, $dominantMake, $lensUsed);
            if (! $lens) {
                // Pas d’objectif => on skip cette focale
                $focaleIndex++;
                continue;
            }

            // Étape C) Vérifier la compatibilité monture
            $sharedMounts = $camera->mounts->intersect($lens->mounts);
            if ($sharedMounts->isEmpty()) {
                // On peut essayer un autre objectif, ou un autre boîtier
                // Pour garder un code simple, on skip la focale
                $focaleIndex++;
                continue;
            }

            // Étape D) Calcul du prix (LOA 36 mois)
            $totalPrice = (float) $camera->price + (float) $lens->price;
            $monthly    = round($totalPrice / 36, 2);

            // Choisir un titre
            $packTitle = match ($packCount) {
                0 => 'Pack Essentiel',
                1 => 'Pack Recommandé',
                2 => 'Pack Premium',
                default => 'Pack #'.($packCount+1),
            };

            // Enregistrer le pack
            $packs->push([
                'title'          => $packTitle,
                'camera'         => $camera,
                'lens'           => $lens,
                'focalRequested' => $focal,
                'price'          => $monthly,
            ]);

            // Marquer qu’on a utilisé ce boîtier / objectif
            $cameraUsed[] = $camera->id;
            $lensUsed[]   = $lens->id;

            // Passer à la focale suivante
            $focaleIndex++;
            $packCount++;
        }

        // Si, à l’issue, on a moins de 3 packs,
        // on peut tenter d’en rajouter en piochant dans les focales suivantes (si >3 focales)
        // ou en dupliquant des focales. Mais ici, on s’en tient à 3 max.
        return view('simulations.final-step', [
            'simulation' => $simulation,
            'packs'      => $packs,
        ]);
    }
    private function findLensForFocal(float $focal, string $dominantMake, array $lensUsed)
    {
        // 1) Tenter un objectif qui couvre exactement la focale
        $candidate = Lens::where('brand', $dominantMake)
            ->whereNotIn('id', $lensUsed)
            ->where('min_focal_length', '<=', $focal)
            ->where('max_focal_length', '>=', $focal)
            ->first();
        if ($candidate) {
            return $candidate;
        }

        // 2) Fallback => tri "le plus proche"
        //    On exclut aussi ceux déjà utilisés.
        $candidate = Lens::where('brand', $dominantMake)
            ->whereNotIn('id', $lensUsed)
            ->orderByRaw("ABS((min_focal_length + max_focal_length)/2 - ?)", [$focal])
            ->first();

        return $candidate;
    }

    /**
     * Sélectionne un boîtier "neuf" (non utilisé) si possible,
     * sinon, si on n’en a plus de dispo, on autorise la réutilisation.
     */
    private function pickCamera($cameras, array $cameraUsed)
    {
        // 1) Tenter un boîtier pas encore utilisé
        $newOne = $cameras->first(function ($cam) use ($cameraUsed) {
            return ! in_array($cam->id, $cameraUsed);
        });

        if ($newOne) {
            return $newOne;
        }

        // 2) Pas de boîtier neuf ? alors on renvoie null,
        //    le code appelant pourra décider de piocher autrement
        return null;
    }
}
