<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
// Mobile Specific Routes
Route::prefix('mobile')->group(function () {
    Route::get('/dashboard', function () {
        return view('mobile.dashboard');
    });
    
    Route::get('/search', function () {
        return view('mobile.search');
    });
});

require __DIR__.'/auth.php';
