<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Item;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AttributeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('attribute.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(AttributeRequest $request): RedirectResponse
  {
    $this->authorize('create', Attribute::class);
    $attributes = Attribute::where('item_id', '=', Session::get('item_id'))->get()->pluck('name')->all();
    if (!in_array($request->name, $attributes)) {
      $attribute = Attribute::create([
        'name' => $request->name,
        'value' => $request->value,
        'unit' => $request->unit,
        'item_id' => Session::get('item_id')
      ]);
    }
    $item = Item::find(Session::get('item_id'));
    return redirect()->route('item.show', compact('item'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Attribute $attribute): View
  {
    return view('attribute.show')->with(['attribute' => $attribute]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Attribute $attribute): View
  {
    return view('attribute.edit')->with(['attribute' => $attribute]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(AttributeRequest $request, Attribute $attribute): RedirectResponse
  {
    $this->authorize('update', $attribute);
    $attributes = Attribute::where('item_id', '=', Session::get('item_id'))->get()->pluck('name')->all();
    if (!in_array($request->name, $attributes)) {
      $attribute->update([
        'name' => $request->name,
        'value' => $request->value,
        'unit' => $request->unit,
        'item_id' => Session::get('item_id')
      ]);
    }
    $item = Item::find(Session::get('item_id'));
    return redirect()->route('item.show', compact('item'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Attribute $attribute): RedirectResponse
  {
    $item = $attribute->item;
    $attribute->delete();
    return redirect()->route('item.show', compact('item'));
  }
}
