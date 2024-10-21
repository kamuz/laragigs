<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

// All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Edit listing
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update listing
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

// Store listing data
Route::post('/listings/', [ListingController::class, 'store'])->middleware('auth');

// Delete listing
Route::delete('/listings/{id}', [ListingController::class, 'delete'])->middleware('auth');

// Single listing
Route::get('/listings/{id}', [ListingController::class, 'show']);

// Manager listings
Route::get('/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show Register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create user
Route::post('/users', [UserController::class, 'store']);

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Login user
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
