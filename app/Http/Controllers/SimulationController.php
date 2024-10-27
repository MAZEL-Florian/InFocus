<?php

namespace App\Http\Controllers;

use App\Models\PhotoType;
use App\Models\Simulation;
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

        return redirect()->route('simulations.photos');
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
}
