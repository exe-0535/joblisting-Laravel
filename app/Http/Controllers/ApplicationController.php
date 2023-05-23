<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Listing;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function manage(Listing $listing) {

        return view('applications.manage', ['applications' => $listing->applications()->where('listing_id', '=', $listing->id)->get(), 'listing' => $listing]);

    }

    public function show() {
        
        return view('applications.show', ['applications' => auth()->user()->applications()->get()]); 

    }

    public function store(StoreApplicationRequest $request, $listing) {


        $formFields = $request->validated();

        $formFields['user_id'] = auth()->id();
        $formFields['listing_id'] = intval($listing);

        if($request->hasFile('cv')) {

            $formFields['cv'] = $request->file('cv')->store('cvs', 'public');

        }

        Application::create($formFields);
        
        
        return redirect('/')->with('message', 'Application created successfully!');
    }

    public function update($listing, $id, $status) {

        Application::where('id', $id)->update(['status' => $status]);

        return redirect('/applications/' . $listing . '/manage')->with('message', 'Application ' . $status . ' successfully!');

    }
}
