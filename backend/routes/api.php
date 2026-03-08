<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// LOGIN
Route::post('/login', [AuthController::class, 'login']);

// TESTIMONI (PUBLIC - bisa diakses website tanpa login)
Route::get('/testimoni', [TestimonialController::class, 'getTestimoni']);

// PPDB PUBLIC
Route::get('/ppdb/public', [PpdbController::class, 'publicData']);


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // PPDB ADMIN
    Route::get('/ppdb/fields',        [PpdbController::class, 'index']);
    Route::post('/ppdb/fields',       [PpdbController::class, 'store']);
    Route::put('/ppdb/fields/{id}',   [PpdbController::class, 'update']);
    Route::delete('/ppdb/fields/{id}',[PpdbController::class, 'destroy']);
    Route::post('/ppdb/status',       [PpdbController::class, 'setStatus']);
    Route::get('/ppdb/status',        [PpdbController::class, 'getStatus']);

    // USER PREFERENCES
    Route::get('/user/preferences',  [UserPreferenceController::class, 'index']);
    Route::post('/user/preferences', [UserPreferenceController::class, 'store']);

    // FASILITAS CRUD
    Route::post('/fasilitas',      [FasilitasController::class, 'store']);
    Route::put('/fasilitas/{id}',  [FasilitasController::class, 'update']);
    Route::delete('/fasilitas/{id}',[FasilitasController::class, 'destroy']);

    // GALERI CRUD
    Route::post('/galeri',      [GaleriController::class, 'store']);
    Route::put('/galeri/{id}',  [GaleriController::class, 'update']);
    Route::delete('/galeri/{id}',[GaleriController::class, 'destroy']);

});