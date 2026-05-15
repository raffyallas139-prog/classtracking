<?php
use App\Http\Controllers\Api\LabApiController;
use Illuminate\Support\Facades\Route;

Route::get('/labs', [LabApiController::class, 'index']);
Route::get('/labs/search', [LabApiController::class, 'search']);