<?php

namespace App\Http\Controllers;
use Hash;
use App\Models\Experts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class ExpertController extends Controller
{
    //register form for expert
    public function create(){
        return view("auth.register");
    }

    //store data(register) of expert
    public function store(Request $request){
        $formFields=$request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:8|max:100|unique:experts',
            'phone_num' => 'required|min:10|max:20|unique:experts',
            'institution_name' => 'required|min:8|max:80',
            'reg_num' => 'required|min:8|max:50|unique:experts',
            'password' => 'required|min:6|max:255'
        ]);

        $formFields['password']=Hash::make($formFields['password']);

        //db insert into command
        $expert=Experts::create($formFields);

        //login
        auth()->login($expert);

        event(new Registered($expert));

        return redirect("/email/verify")->with('message','User created and logged In.');
    }

    //login form for expert
    public function login(){
        return view("auth.login");
    }

    //authenticate an expert
    public function authenticate(Request $request){
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
