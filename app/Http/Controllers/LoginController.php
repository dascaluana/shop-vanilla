<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('login.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

        if (request()->expectsJson()) {
            return response()->json();
        }

        return redirect('products');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->logout();

        if (request()->expectsJson()) {
            return response()->json();
        }

        return redirect()->home();
    }
}
