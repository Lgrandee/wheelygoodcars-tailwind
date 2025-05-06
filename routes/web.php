<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Models\Car;


Route::get('/', [CarsController::class , 'index'])->name('home');

Route::get('create', function () {

})->name('create');


Route::middleware(['auth'])->group(function () {
    Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarsController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');
    Route::get('/mijn-aanbod', [CarsController::class, 'myOffers'])->name('cars.myOffers');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');
});

require __DIR__.'/auth.php';
?>
