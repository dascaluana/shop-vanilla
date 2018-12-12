<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        // Validate the form

        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        //Create and save the user

        $data = request(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        //Sign them in

        auth()->login($user);

        //Redirect to the homepage

        return redirect('/');
    }
}
