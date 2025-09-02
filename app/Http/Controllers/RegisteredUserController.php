<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validate
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'confirmed'],
            'password' => ['required', Password::min(5), 'confirmed'],
        ]);
        // create user
        $user = User::create($attributes);
        // login
        Auth::login($user);
        //redirect
        return redirect('/jobs');
    }
}