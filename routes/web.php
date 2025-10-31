<?php

use App\Http\Controllers\EsdevenimentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, '__invoke']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// rutes que poden accedir tots els usuaris registrats
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/esdevenimen', [EsdevenimentController::class, 'index'])->name('esdevenimen.index');
    Route::get('/esdevenimen/show/{id}', [EsdevenimentController::class, 'show'])->name('esdevenimen.show');
    Route::get('/esdevenimen/byCategory/{id}', [EsdevenimentController::class, 'byCategory'])->name('esdevenimen.byCategory');
    Route::post('/esdevenimen/{esdeveniment}/reserve', [EsdevenimentController::class, 'reserve'])->name('esdevenimen.reservar');
    Route::delete('/esdevenimen/{id}/cancelar', [EsdevenimentController::class, 'cancelarReserva'])->name('esdevenimen.cancelarReserva');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
});

// rutes on nomes pot accedir el administrador
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    Route::get('/esdevenimen/create', [EsdevenimentController::class, 'create'])->name('esdevenimen.create');
    Route::post('/esdevenimen/store', [EsdevenimentController::class, 'store'])->name('esdevenimen.store');
    Route::get('/esdevenimen/edit/{id}', [EsdevenimentController::class, 'edit'])->name('esdevenimen.edit');
    Route::put('/esdevenimen/{id}', [EsdevenimentController::class, 'update'])->name('esdevenimen.update');
    Route::delete('/esdevenimen/{id}', [EsdevenimentController::class, 'destroy'])->name('esdevenimen.destroy');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

require __DIR__ . '/auth.php';
