<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        //Attempt to auth the user

        if (! auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        //Redirect to the home page

        return redirect()->route('index');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
