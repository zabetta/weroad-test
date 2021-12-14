<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TravelController;
use App\Http\Controllers\TourController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/travels', [TravelController::class,'index'])->name('travels.getAll');
Route::get('/travels/create', [TravelController::class,'create'])->middleware(['auth'])->name('travels.create');
Route::post('/travels/save', [TravelController::class,'store'])->name('travels.store');
Route::get('/travels/{slug}', [TravelController::class,'showBySlug'])->name('travels.details');
Route::post('/travels/{slug}', [TravelController::class,'filterTours'])->name('travels.filter');

Route::get('/tours/create', [TourController::class,'create'])->middleware(['auth'])->name('tours.create');
Route::post('/tours/save', [TourController::class,'store'])->name('tours.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
