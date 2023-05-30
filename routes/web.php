<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CVDownloadController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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



// All Listings / Home Page
Route::get('/', [ListingController::class, 'index']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Single Listing
Route::get('listings/{listing}', [ListingController::class, 'show']);

// User authorization routes
Route::middleware(['auth'])->group(function() {

    // Listings group
    Route::controller(ListingController::class)->group(function() {

        Route::prefix('listings')->group(function() {

            // Show create form 
            Route::get('/create', 'create')->middleware(['role:employer']);

            // Manage Listings
            Route::get('/manage', 'manage')->middleware(['role:employer']);

            // Store Listing
            Route::post('', 'store')->middleware(['role:employer']);
            
            // Show Edit Form
            Route::get('/{listing}/edit', 'edit')->middleware(['role:employer']);

            // Update Listing
            Route::put('/{listing}', 'update')->middleware(['role:employer']);

            // Delete Listing
            Route::delete('/{listing}', 'destroy')->middleware(['role:employer']);
        });

    });

    // Mark notification as read
    Route::get('/markAsRead/{id}', function($id) {

        auth()->user()->notifications->where('id', $id)->markAsRead();
        
        return redirect()->back();

    });

    // Download CV
    Route::get('/download/{cv}', [CVDownloadController::class, 'download'])->name('download')->middleware(['role:employer']);

    // Applications group
    Route::controller(ApplicationController::class)->group(function() {

        // Show applications of a User
        Route::get('/applications/show', 'show')->middleware(['role:seeker']);

        // Store an Application
        Route::post('/applications/{listing}', 'store')->middleware(['role:seeker']);

        // Show Applications for a Listing
        Route::get('/applications/{listing}/manage', 'manage')->middleware(['role:employer']);

        // Update Application Status
        Route::put('/applications/{listing}/{id}/{status}', 'update')->middleware(['role:employer']);
    });

    // Log User Out
    Route::post('/logout', [UserController::class, 'logout']);
});

// User Controller routes
Route::controller(UserController::class)->group(function() {

    // Show role choosing form before registering
    Route::get('/register/role', 'roleChoosing')->middleware('guest');;

    // Show Register/Create Form
    Route::get('/register/{role}', 'create')->middleware('guest');

    // Log In User
    Route::post('/users/authenticate', 'authenticate');

    // Create New User
    Route::post('/users/{role}', 'store');
});

