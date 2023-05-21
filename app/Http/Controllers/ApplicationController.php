<?php

namespace App\Http\Controllers;

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
}
