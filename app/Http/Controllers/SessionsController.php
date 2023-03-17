<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //validating
        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes)){
            //auth successfull
            session()->regenerate(); //for preventing session fixation
            return redirect('/')->with('success', 'Welcome Back!');
        }

        //if auth failed
//        Method - 1
//        return back()
//            ->withInput()
//            ->withErrors(['email' => 'Your provided credentials could not be verified']);

//        method - 2
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
