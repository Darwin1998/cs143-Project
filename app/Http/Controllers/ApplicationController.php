<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function authenticate(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if(Auth::attempt($credentials))
        {
            return redirect('home');
        }
        else
        {
            return redirect('login')->withErrors([

                'message' => 'Invalid Email or Password'

                ]);
        }


    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
