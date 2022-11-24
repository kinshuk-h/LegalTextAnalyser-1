<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Experts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    //register form for expert
    public function showRegistrationForm(){
        return view("auth.register");
    }

    //store data(register) of expert
    public function register(Request $request){
        $formFields=$request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:8|max:100|unique:experts',
            'phone_num' => 'required|min:10|max:20|unique:experts',
            'institution_name' => 'required|min:8|max:80',
            'reg_num' => 'required|min:8|max:50|unique:experts',
            'password' => 'required|min:8|max:255'
        ]);

        $formFields['password']=Hash::make($formFields['password']);

        //db insert into command
        $expert=Experts::create($formFields);

        //assign anotator role
        $expert->assignRole(Roles::ANNOTATOR);

        //login
        auth()->login($expert);

        event(new Registered($expert));

        return redirect("/email/verify")->with('message','You are registered and logged In.');
    }
}
