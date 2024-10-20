<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

// All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// Edit listing
Route::get('/listings/{id}/edit', [ListingController::class, 'edit']);

// Update listing
Route::put('/listings/{id}', [ListingController::class, 'update']);

// Store listing data
Route::post('/listings/', [ListingController::class, 'store']);

// Delete listing
Route::delete('/listings/{id}', [ListingController::class, 'delete']);

// Single listing
Route::get('/listings/{id}', [ListingController::class, 'show']);