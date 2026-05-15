
<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaboratoryController;
use Illuminate\Support\Facades\Route;

// Public Paths (Accessible by both Web & Mobile Clients)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/labs', [LaboratoryController::class, 'index']);
Route::get('/labs/search', [LaboratoryController::class, 'search']);

// System Authenticated Route Group
Route::middleware('auth:sanctum')->group(function () {
    
    // Strict Verification Rules Engine Gateway (Faculty Only)
    Route::middleware(\App\Http\Middleware\EnsureUserIsFaculty::class)->group(function () {
        Route::put('/labs/{id}/status', [LaboratoryController::class, 'updateStatus']);
    });
    
});