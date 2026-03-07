<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\UserPreferenceController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);
});

// PUBLIC (tidak perlu login)
Route::get('/ppdb/public', [PpdbController::class, 'publicData']);

// ADMIN (perlu login) //
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ppdb/fields',        [PpdbController::class, 'index']);
    Route::post('/ppdb/fields',       [PpdbController::class, 'store']);
    Route::put('/ppdb/fields/{id}',   [PpdbController::class, 'update']);
    Route::delete('/ppdb/fields/{id}',[PpdbController::class, 'destroy']);
    Route::post('/ppdb/status',       [PpdbController::class, 'setStatus']);
    Route::get('/ppdb/status',        [PpdbController::class, 'getStatus']);

    // User Preferences (Dark Mode & Tema Warna)
    Route::get('/user/preferences',  [UserPreferenceController::class, 'index']);
    Route::post('/user/preferences', [UserPreferenceController::class, 'store']);
    
});