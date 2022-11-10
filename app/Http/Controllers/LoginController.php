<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login form for expert
    public function showLoginForm(){
        return view("auth.login");
    }

    //authenticate an expert
    public function login(Request $request){
        $formFields=$request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    //logout an expert
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
}
