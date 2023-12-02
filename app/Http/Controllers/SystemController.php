<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\System;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SystemRequest;
use Illuminate\Support\Facades\Session;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $systems = System::whereIn('building_id', function ($query) {
            $query->select('id')
                ->from('buildings')
                ->where('user_id', Session::get('user_id'));
        })->get()->all();
        return view('system.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', System::class);
        $buildings = Building::where('user_id', '=', Session::get('user_id'))->get()->all();
        return view('system.create', compact('buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SystemRequest $request)
    {
        $this->authorize('create', System::class);
        $system = System::create([
            'name' => $request->name,
            'building_id' => $request->building_id,
            'budget' => $request->budget,
        ]);
        return redirect(route('system.show', compact('system')));
    }

    /**
     * Display the specified resource.
     */
    public function show(System $system)
    {
        $this->authorize('view', $system);
        Session::put('system_id', $system->id);
        Session::put('system_name', $system->name);
        $buildings = Building::where('user_id', '=', Session::get('user_id'))->get()->all();
        return view('system.show', compact('system', 'buildings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(System $system): View
    {
        $this->authorize('update', $system);
        $buildings = Building::where('user_id', '=', Session::get('user_id'))->get()->all();
        return view('system.edit', compact('system', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SystemRequest $request, System $system)
    {
        $this->authorize('update', $system);
        $system->update([
            'name' => $request->name,
            'building_id' => $request->building_id,
            'budget' => $request->budget,
        ]);
        return redirect(route('system.show', compact('system')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(System $system)
    {
        $this->authorize('delete', $system);
        $system->delete();
        return redirect(route('system.index'));
    }
}
