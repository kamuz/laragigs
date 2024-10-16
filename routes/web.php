<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;

Route::get('/', function () {
    return view('listings', [
        'heading' => "Latest Listings",
        'listings' => Listing::all(),
    ]);
});