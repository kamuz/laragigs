<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

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

// Show Register form
Route::get('/register', [UserController::class, 'create']);

// Create user
Route::post('/users', [UserController::class, 'store']);

// Logout user
Route::post('/logout', [UserController::class, 'logout']);

// Login user
Route::get('/login', [UserController::class, 'login']);

// Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);