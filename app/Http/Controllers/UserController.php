<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register / Create Form

    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(CreateUserRequest $request) {
        
        $formFields = $request->validated();

        // Hash Password

        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        
        $user = User::create($formFields);

        // Login

        auth()->login($user);

        return redirect('/')->with('message', 'Successfully signed up!');

    }

    // Logout User

    public function logout(Request $request) {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out!');

    }

    // Show Login Form

    public function login() {
        return view('users.login');
    }

    // Authenticate User

    public function authenticate(AuthenticateUserRequest $request) {
        $formFields = $request->validated();

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');

        }

        return back()->withErrors(['email' => "Invalid Credentials"])->onlyInput('email');
    }

}
