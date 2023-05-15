<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show a single listing
// create - Show form to create a new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing


// All Listings

Route::get('/', [ListingController::class, 'index']);

// Show create Form

Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing Data

Route::post('/listings', [ListingController::class, 'store']);

// Single Listing

Route::get('/listings/{listing}', [ListingController::class, 'show']);