<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TravelController;
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
Route::get('/travels/{slug}', [TravelController::class,'showBySlug'])->name('travels.details');
Route::post('/travels/{slug}', [TravelController::class,'filterTours'])->name('travels.filter');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';
