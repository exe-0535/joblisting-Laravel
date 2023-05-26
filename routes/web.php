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


// Listings group

Route::controller(ListingController::class)->group(function() {
    Route::prefix('listings')->group(function() {
        Route::middleware(['auth'])->group(function() {
            
            // Show create form 
            Route::get('/create', 'create');

            // Manage Listings
            Route::get('/manage', 'manage');

            // Store Listing
            Route::post('', 'store');

            // Show Edit Form
            Route::get('/{listing}/edit', 'edit');

            // Update Listing
            Route::put('/{listing}', 'update');

            // Delete Listing
            Route::delete('/{listing}', 'destroy');
        });

        // Single Listing
        Route::get('/{listing}', 'show');
    });

    // All Listings
    Route::get('/', 'index');
});

// Mark notification as read

Route::get('/markAsRead/{id}', function($id) {

    auth()->user()->notifications->where('id', $id)->markAsRead();
    
    return redirect()->back();

})->middleware('auth');



// Download CV

Route::get('/download/{cv}', [CVDownloadController::class, 'download'])->name('download')->middleware('auth');;



// Show applications of a User

Route::get('/applications/show', [ApplicationController::class, 'show'])->middleware('auth');;


// Store an Application

Route::post('/applications/{listing}', [ApplicationController::class, 'store'])->middleware('auth');;


// Show Applications for a Listing

Route::get('/applications/{listing}/manage', [ApplicationController::class, 'manage'])->middleware('auth');;


// Update Application Status

Route::put('/applications/{listing}/{id}/{status}', [ApplicationController::class, 'update'])->middleware('auth');;




// Show role choosing form before registering

Route::get('/register/role', [UserController::class, 'roleChoosing'])->middleware('guest');;

// Show Register/Create Form

Route::get('/register/{role}', [UserController::class, 'create'])->middleware('guest');

// Log In User

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Create New User

Route::post('/users/{role}', [UserController::class, 'store']);

// Log User Out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
