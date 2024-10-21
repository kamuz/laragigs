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

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', 'unique:listings,company'],
            'location' => 'required',
            'email' => ['required'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            // dd($request->file('logo')->store('logos', 'public'));
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        // dd($formFields);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created');
    }

    // Update form
    public function update(Request $request, $id) {

        $listing = Listing::find($id);

        // Make sure logged user is owner of current listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            // dd($request->file('logo')->store('logos', 'public'));
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing update successfully!');
    }

    // Edit listing
    public function edit($id) {
        // dd(Listing::find($id));
        $listing = Listing::find($id);

        // Make sure logged user is owner of current listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        return view('listings.edit', ['listing' => $listing]);
    }

    // Delete listing
    public function delete($id) {

        $listing = Listing::find($id);

        // Make sure logged user is owner of current listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        // dd(Listing::find($id));
        $listing = Listing::find($id)->delete();

        return redirect('/')->with('message', 'Listing was delete');
    }

    // Manager listings
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
