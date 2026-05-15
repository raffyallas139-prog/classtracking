<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
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

Route::get('/', function () { return redirect('/login'); });

Route::get('/login', [WebController::class, 'showLogin'])->name('login');
Route::post('/login', [WebController::class, 'handleLogin']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [WebController::class, 'dashboard']);
    Route::put('/labs/{id}/toggle', [WebController::class, 'toggleStatus']);
    Route::post('/logout', [WebController::class, 'logout']);
});

require __DIR__.'/auth.php';
