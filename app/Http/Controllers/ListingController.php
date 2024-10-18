<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        // dd(request('tag'));
        if (request('tag')){
            return view('listings.index', [
                'listings' => Listing::where('tags', 'like', '%' . request('tag') . '%')->get(),
            ]);
        } elseif (request('search')) {
            return view('listings.index', [
                'listings' => DB::table('listings')
                    ->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%')
                    ->orWhere('tags', 'like', '%' . request('search') . '%')
                    ->orWhere('company', 'like', '%' . request('search') . '%')
                    ->orWhere('location', 'like', '%' . request('search') . '%')
                    ->get()
            ]);
        } else {
            return view('listings.index', [
                'listings' => Listing::all(),
            ]);
        }
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
