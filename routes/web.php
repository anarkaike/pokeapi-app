<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::prefix('pokemons')->name('pokemons.')->group(function () {
        Route::get('/',              [PokemonController::class, 'index'])->name('index');
        Route::post('/import',       [PokemonController::class, 'sync'])->name('sync');
        Route::post('/sync-all',     [PokemonController::class, 'syncAll'])->name('sync-all');
        Route::get('/sync-progress', [PokemonController::class, 'syncProgress'])->name('sync-progress');
        Route::get('/{pokemon}',     [PokemonController::class, 'show'])->name('show');
        Route::delete('/{pokemon}',  [PokemonController::class, 'destroy'])->name('destroy');

        Route::post('/{pokemon}/favorite', [PokemonController::class, 'toggleFavorite'])->name('favorite');
    });

    Route::resource('users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->middleware('can:viewAny,App\Models\User');

    Route::resource('users', UserController::class)
        ->only(['show', 'edit', 'update'])
        ->middleware('can:update,user');

    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
