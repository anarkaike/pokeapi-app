<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->middleware(['verified'])->name('dashboard');

    Route::get('/pokemons', fn () => view('pages.pokemons'))->middleware(['verified'])->name('pokemons');
    Route::get('/types', fn () => view('pages.types'))->middleware(['verified'])->name('types');
    Route::get('/abilities', fn () => view('pages.abilities'))->middleware(['verified'])->name('abilities');
    Route::get('/moves', fn () => view('pages.moves'))->middleware(['verified'])->name('moves');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
