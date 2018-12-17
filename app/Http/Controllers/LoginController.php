<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        $validator = \Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        $validator->after(function($v){
            /** @var \Illuminate\Validation\Validator $v */
            if ($v->failed()) {
                return;
            }

            if (! auth()->attempt(request(['email', 'password']))) {
                $v->errors()->add('message', 'Please check your credentials and try again.');
            }
        });

        $validator->validate();

        return redirect()->route('products');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
