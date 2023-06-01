<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreListingRequest;

class ListingController extends Controller
{
    // Show all listings
    public function index() {

        if(strlen(request('location')) > 0) {

            $apiresponse = Http::get('https://nominatim.openstreetmap.org/search?q=' . request('location') . '&format=json&limit=1')->object();

            if(count($apiresponse) < 1) {
                return redirect()->back()->withErrors(['location' => 'Please enter a valid location'])->withInput();
            }

            $lat = $apiresponse[0]->lat;
            $lon = $apiresponse[0]->lon;

            if(is_null(request()->range)) {
                $range = 10;
            } else {
                $range = request()->range;
                if($range < 10 || $range > 250) {
                    return redirect()->back()->withErrors(['range' => 'Please enter a valid range'])->withInput();
                }
            }
            
            $haversine = "(
                6371 * acos(
                    cos(radians(" .$lat. "))
                    * cos(radians(`latitude`))
                    * cos(radians(`longitude`) - radians(" .$lon. "))
                    + sin(radians(" .$lat. ")) * sin(radians(`latitude`))
                )
            )";

            return view('listings.index', [
                'listings' => Listing::selectRaw("*, $haversine AS distance")->latest()->having("distance", "<=", $range)->filter(request(['tag', 'search']))->paginate(6)
            ]);

        }

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

        // Get all tags from the form
        $tags = [];

        foreach($request->tags as $tag) {
            $keys = array_keys($tag);
            foreach($keys as $key) {
                array_push($tags, Tag::where('name', '=', $key)->first()->id);
            }
        }

        // dd($tags);

        $apiresponse = Http::get('https://nominatim.openstreetmap.org/search?q=' . $request->location . '&format=json&limit=1')->object();

        if(count($apiresponse) < 1) {
            return redirect()->back()->withErrors(['location' => 'Please enter a valid location'])->withInput();
        }

        $formFields = $request->validated();
        unset($formFields['tags']);

        $formFields['user_id'] = auth()->id();
        $formFields['latitude'] = $apiresponse[0]->lat;
        $formFields['longitude'] = $apiresponse[0]->lon;

        if($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }

        $listing = Listing::create($formFields);
        $listing->tags()->attach($tags);
        
        
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        $this->authorize('edit', $listing);
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update listing

    public function update(StoreListingRequest $request, Listing $listing) {
        $apiresponse = Http::get('https://nominatim.openstreetmap.org/search?q=' . $request->location . '&format=json&limit=1')->object();

        if(count($apiresponse) < 1) {
            return redirect()->back()->withErrors(['location' => 'Please enter a valid location'])->withInput();
        }

        $this->authorize('update', $listing);
        $formFields = $request->validated();
        $formFields['latitude'] = $apiresponse[0]->lat;
        $formFields['longitude'] = $apiresponse[0]->lon;

        if($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }

        $listing->update($formFields);
        
        
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete a listing

    public function destroy(Listing $listing) {

        $this->authorize('destroy', $listing);

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');

    }

    // Manage Listings

    public function manage() {

        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);

    }
}


