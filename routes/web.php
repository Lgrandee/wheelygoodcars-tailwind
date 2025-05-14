<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\AuthController;

Route::get('/', [CarsController::class, 'index'])->name('home');

// Detailpagina voor auto's
Route::get('/cars/{car}', [CarsController::class, 'show'])->name('cars.show');

// Routes voor het plaatsen van biedingen
Route::get('/cars/{car}/bet', [CarsController::class, 'bet'])->name('cars.bet');
Route::post('/cars/{car}/bet', [CarsController::class, 'placeBet'])->name('cars.placeBet');

// Voor geauthenticeerde gebruikers
Route::middleware(['auth'])->group(function () {
    // Auto's overzicht en beheer
    Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
    Route::get('/create', [CarsController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');
    Route::get('/mijn-aanbod', [CarsController::class, 'myOffers'])->name('cars.myOffers');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Voor biedingen
Route::post('/bids', [BidController::class, 'store'])->name('bet.store');


// Welkomstpagina
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/welcome', [CarsController::class, 'index'])->name('welcome');

require __DIR__.'/auth.php';
?>
