<?php

use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/appliance', ApplianceController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/attribute', AttributeController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/building', BuildingController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/item', ItemController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/room', RoomController::class)
    ->middleware(['auth', 'verified']);

Route::get('/search', function (Request $request) {
    $search = $request->input('search');

    Session::put('search', preg_replace('/[^A-Za-z0-9 .]/', '', $search));
    dd($request);
    return redirect(route('item.index'));
})
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
