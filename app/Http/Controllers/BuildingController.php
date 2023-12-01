<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        
        return view("building.index")->with(['buildings' => Building::where('user_id', Session::get('user_id'))->get()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('building.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BuildingRequest $request): RedirectResponse
    {
        $this->authorize('create', Building::class);
        $buildings = Building::where('user_id', '=', $request->user()->id)->get()->pluck('name')->all();
        if (!in_array($request->name, $buildings)) {
            $building = Building::create([
                'name' => $request->name,
                'user_id' => $request->user()->id
            ]);
            return redirect()->route('building.show', compact('building'));
        }
        return redirect()->route('building.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building): View
    {
        $this->authorize('view', $building);
        Session::put('building_id', $building->id);
        Session::put('building_name', $building->name);
        $power = $building->calculatePowerConsumption();
        $rooms = $building->room;
        return view('building.show', compact('building', 'power', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building): View
    {
        $this->authorize('update', $building);
        Session::put('building_id', $building->id);
        Session::put('building_name', $building->name);
        $power = $building->calculatePowerConsumption();
        $rooms = $building->room;
        return view('building.edit', compact('building', 'power', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building): RedirectResponse
    {
        $this->authorize('update', $building);
        $buildings = Building::where('user_id', '=', $request->user()->id)->get()->pluck('name')->all();
        if (!in_array($request->name, $buildings)) {
            $building->update([
                'name' => $request->name
            ]);
            return redirect()->route('building.show', compact('building'));
        }
        return redirect()->route('building.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building): RedirectResponse
    {
        $this->authorize('delete', $building);
        $building->delete();
        return redirect()->route('building.index');
    }
}
