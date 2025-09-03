<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //validate
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //attempt to login the user
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Nao Nao Amigao, Invalid credentials'
            ]);
        }
            //regenerate session token, esto evita hackeos o lo intenta
            request()->session()->regenerate();
            //redirect
            return redirect('/jobs');


        //if login fails, return with error
        // return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
