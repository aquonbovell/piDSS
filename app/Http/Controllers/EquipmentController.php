<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EquipmentRequest;
use Illuminate\Support\Facades\Session;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Equipment::class);
        $items = Item::all();
        return view('equipment.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentRequest $request)
    {
        $this->authorize('create', Equipment::class);
        $equipment = Equipment::create([
            'item_id' => $request->item_id,
            'system_id' => Session::get('system_id'),
            'quantity' => $request->quantity
        ]);
        return redirect(route('equipment.show', compact('equipment')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment): View
    {
        $this->authorize('view', $equipment);
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment): View
    {
        $this->authorize('update', $equipment);
        $items = Item::all();
        return view('equipment.edit', compact('equipment' , 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentRequest $request, Equipment $equipment): RedirectResponse
    {
        $this->authorize('update', $equipment);
        $equipment->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity
        ]);
        return redirect(route('equipment.show', compact('equipment')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $this->authorize('delete', $equipment);
        $system = $equipment->system;
        $equipment->delete();
        return redirect(route('system.show', compact('system')));
    }
}
