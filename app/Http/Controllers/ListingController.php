<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::where('tags', 'like', '%' . request('tag') . '%')->get(),
        ]);
    }

    // Show single listing
    public function show($id) {
        $listing = Listing::find($id);
        if ($listing){
            return view('listings.show', [
                'listing' => $listing
            ]);
        } else {
            abort('404');
        }
    }
}
