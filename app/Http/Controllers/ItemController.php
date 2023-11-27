<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): View
	{
		return view('item.index')->with(['items' => Item::all()]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('item.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ItemRequest $request): RedirectResponse
	{
		$this->authorize('create', Item::class);
		$item = Item::create([
			'name' => $request->name,
			'description' => $request->description,
			'quantity' => $request->quantity,
			'category' => $request->category,
			'price' => $request->price
		]);
		return redirect()->route('item.show', compact('item'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Item $item): View
	{
		Session::put('item_id', $item->id);
		Session::put('item_name', $item->name);
		return view('item.show')->with(['item' => $item]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Item $item): View
	{
		return view('item.edit')->with(['item' => $item]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(ItemRequest $request, Item $item): RedirectResponse
	{
		$this->authorize('update', $item);
		$item->update([
			'name' => $request->name,
			'description' => $request->description,
			'quanity' => $request->quanity,
			'category' => $request->category,
			'price' => $request->price
		]);
		return redirect()->route('item.show', compact('item'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Item $item): RedirectResponse
	{
		$item->delete();
		return redirect()->route('item.index');
	}
}
