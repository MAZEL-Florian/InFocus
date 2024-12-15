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


            return redirect()->route('simulations.createStepOne', ['simulation' => $simulation]);
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
        // dd($simulation, request()->selectedPhotos);
        // dd(request()->selectedPhotos);
        $rules = array(
            'selectedPhotos' => 'required|array',
            'selectedPhotos.*' => 'exists:photos,id',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('simulation/' . $simulation->uuid . '/step-one')
                ->withErrors($validator);
        }
        $selectedPhotos = Photo::whereIn('id', $request->input('selectedPhotos'))->get();
        // dd($selectedPhotos);

        foreach ($selectedPhotos as $photo) {
            // dd($photo);
            $simulationPhoto = new SimulationPhoto;
            $simulationPhoto->simulation_id = $simulation->id;
            $simulationPhoto->photo_id = $photo->id;
            $simulationPhoto->save();
        }

        // Récupérer des photos correspondant a la colorimétrie
        // Exemple : If 2 canon, récupérer toutes les photos réalisées par canon
        // If 1 canon, 1 nikon et 1 sony, récupérer des photos différentes
        $makeCounts = $selectedPhotos->groupBy('make')->map->count();
        // Déterminer la condition pour la récupération des photos supplémentaires
        if ($makeCounts->count() === 1) {
            // Si l'utilisateur a sélectionné plusieurs fois la même marque
            $make = $makeCounts->keys()->first();
            $photos = Photo::where('make', $make)
                ->whereHas('photoTypes', function ($query) use ($simulation) {
                    $query->where('photo_types.id', $simulation->photo_type_id);
                })
                ->get()
                ->groupBy('make');
        } else {
            // Si l'utilisateur a sélectionné différentes marques
            $photos = Photo::whereHas('photoTypes', function ($query) use ($simulation) {
                $query->where('photo_types.id', $simulation->photo_type_id);
            })
                ->get()
                ->groupBy('make');
        }
        // dd($photos);


        // dd($validator);

        return redirect()->route('simulation.create-step-two', compact('simulation', 'photos'));
    }

    public function createStepTwo(Request $request, Simulation $simulation)
    {
        $photos = Photo::select('photos.*')
            ->join('photo_type_photos', 'photos.id', '=', 'photo_type_photos.photo_id')
            ->join('photo_types', 'photo_type_photos.photo_type_id', '=', 'photo_types.id')
            ->where('photo_types.id', '=', $simulation->photo_type_id)
            ->get()
            ->groupBy('make');

        $selectedPhotos = [];
        $counter = 0;

        while (count($selectedPhotos) < 9 && $counter < 3) {
            foreach ($photos as $make => $photoGroup) {
                if (isset($photoGroup[$counter])) {
                    $selectedPhotos[] = $photoGroup[$counter];
                }
                if (count($selectedPhotos) >= 9) {
                    break;
                }
            }
            $counter++;
        }

        $photosByGroups = array_chunk($selectedPhotos, 3);
        dd($photosByGroups);
        return view('simulations.step-two', compact('photosByGroups', 'simulation'));
    }
}
