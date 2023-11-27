<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RoomController extends Controller
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
		$this->authorize('view', Room::class);
		return view('room.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(RoomRequest $request): RedirectResponse
	{
		$this->authorize('create', Room::class);
		$rooms = Room::where('building_id', '=', Session::get('building_id'))->get()->pluck('name')->all();
		if (!in_array($request->name, $rooms)) {
			$room = Room::create([
				'name' => $request->name,
				'building_id' => Session::get('building_id'),
			]);
			return redirect()->route('room.show', compact('room'));
		}
		$building = Building::find(Session::get('building_id'));
		return redirect()->route('building.show', compact('building'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Room $room): View
	{
		$this->authorize('view', $room);
		Session::put('room_id', $room->id);
		Session::put('room_name', $room->name);
		$appliances = $room->appliance;
		$power = $room->appliance->sum('power');
		return view('room.show', compact('room', 'appliances', 'power'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Room $room): View
	{
		$this->authorize('view', $room);
		return view('room.edit')->with(['room' => $room]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(RoomRequest $request, Room $room)
	{
		$this->authorize('update', $room);
		$rooms = Room::where('building_id', '=', Session::get('building_id'))->get()->pluck('name')->all();
		if (!in_array($request->name, $rooms)) {
			$room->update([
				'name' => $request->name,
				'building_id' => Session::get('building_id')
			]);
			return redirect()->route('room.show', compact('room'));
		}
		$building = Building::find(Session::get('building_id'));
		return redirect()->route('building.show', compact('building'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Room $room): RedirectResponse
	{
		$this->authorize('delete', $room);
		$building = $room->building;
		$room->delete();
		return redirect()->route('building.show', compact('building'));
	}
}
