<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data

    public function store(StoreListingRequest $request) {

        $formFields = $request->validated();

        $formFields['user_id'] = auth()->id();

        if($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }

        Listing::create($formFields);
        
        
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update listing

    public function update(StoreListingRequest $request, Listing $listing) {

        // Make sure logged in user is owner

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validated();

        if($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }

        $listing->update($formFields);
        
        
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete a listing

    public function destroy(Listing $listing) {

        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');

    }

    // Manage Listings

    public function manage() {

        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);

    }
}


