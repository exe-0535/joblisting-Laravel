<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {

    return response('Hello World!');

});

Route::get('/posts/{id}', function($id) {

    // Die dump helpers

    dd($id);
    ddd($id);

    return response('Post ' . $id);

})->where('id', '[0-9]+'); // Constraint for only inputing numbers


// Requests & query params

Route::get('/search', function(Request $request) {

    dd($request->name . ' ' . $request->city);

});