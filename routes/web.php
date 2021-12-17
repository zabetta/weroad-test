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


//list of travels (5)
Route::get('/travels', [TravelController::class,'index'])->name('travels.all');
Route::get('/travels/view/{id}', [TravelController::class,'show'])->name('travels.show');
//single travel by slug with filters
Route::post('/travels', [TravelController::class,'filterTours'])->name('travels.filter');

//travel creation (if auth) (2)
Route::get('/travels/create', [TravelController::class,'create'])->middleware(['auth'])->name('travels.create');
Route::post('/travels/save', [TravelController::class,'store'])->name('travels.store');

//travel edit and update (if auth) (4)
Route::get('/travels/edit/{id}', [TravelController::class,'edit'])->middleware(['auth'])->name('travels.edit');
Route::post('/travels/update', [TravelController::class,'update'])->name('travels.update');

//tour creation (if auth) (3)
Route::get('/tours/create/{id}', [TourController::class,'create'])->middleware(['auth'])->name('tours.create');
Route::post('/tours/save', [TourController::class,'store'])->name('tours.store');

//single tour by id (7)
Route::get('/tours/{id}', [TourController::class,'show'])->name('tours.show');


//single travel by slug (6)
Route::get('/travels/{slug}', [TravelController::class,'showBySlug'])->name('travels.details');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';
