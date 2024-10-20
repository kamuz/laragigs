<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

    // Create form
    public function create() {
        return view('listings.create');
    }

    // Store form
    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', 'unique:listings,company'],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created');
    }
}
