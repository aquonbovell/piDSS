<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplianceRequest;
use App\Models\Appliance;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ApplianceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('building.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Appliance::class);
        return view('appliance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplianceRequest $request): RedirectResponse
    {
        $this->authorize('create', Appliance::class);
        $appliances = Appliance::where('room_id', '=', Session::get('room_id'))->get()->pluck('name')->all();
        if (!in_array($request->name, $appliances)) {
            $appliance = Appliance::create([
                'name' => $request->name,
                'room_id' => Session::get('room_id'),
                'power' => $request->power
            ]);
            return redirect()->route('appliance.show', compact('appliance'));
        }
        $room = Room::find(Session::get('room_id'));
        return redirect()->route('room.show', compact('room'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Appliance $appliance): View
    {
        $this->authorize('view', $appliance);
        return view('appliance.show', compact('appliance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appliance $appliance): View
    {
        $this->authorize('view', $appliance);
        return view('appliance.edit', compact('appliance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApplianceRequest $request, Appliance $appliance): RedirectResponse
    {
        $this->authorize('update', $appliance);
        $appliances = Appliance::where('room_id', '=', Session::get('room_id'))->get()->pluck('name')->all();
        if (!in_array($request->name, $appliances)) {
            $appliance->update([
                'name' => $request->name,
                'room_id' => Session::get('room_id')
            ]);
            return redirect()->route('appliance.show', compact('appliance'));
        }
        $room = Room::find(Session::get('room_id'));
        return redirect()->route('room.show', compact('room'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appliance $appliance): RedirectResponse
    {
        $this->authorize('delete', $appliance);
        $room = $appliance->room;
        $appliance->delete();
        return redirect()->route('room.show', compact('room'));
    }
}
