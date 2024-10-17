<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;

Route::get('/', function () {
    return view('listings', [
        'heading' => "Latest Listings",
        'listings' => Listing::all(),
    ]);
});

Route::get('/listings/{id}', function($id){
    $listing = Listing::find($id);
    if ($listing){
        return view('listing', [
            'listing' => $listing
        ]);
    } else {
        abort('404');
    }

});