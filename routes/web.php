<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkinController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\WeaponCaseController;
use Illuminate\Support\Facades\Route;

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

Route::get('/weapons', function() {
})->name('weapons');

Route::resource('weapons', WeaponController::class);

Route::resource('skins', SkinController::class);

Route::resource('cases', WeaponCaseController::class)->parameters([
    'cases' => 'name',
]);

/* Route::get('/skin/{market_hash_name}', SkinController::class); */

require __DIR__.'/auth.php';
