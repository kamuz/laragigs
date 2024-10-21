<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show Register/Create form
    public function create() {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout user
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Login user
    public function login(){
        return view('users.login');
    }

    // Log in user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now login in');
        }

        return back()->withErrors(['email' => 'invalid email or password'])->onlyInput('email');
    }
}
