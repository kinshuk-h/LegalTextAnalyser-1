<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditUserDetailsController extends Controller
{
    public function editDetails(Request $request){
        return view("dashboard.profile.index");
    }

    public function updateDetails(Request $request){
        $id=auth()->user()->id;
        $formFields=$request->validate([
            'name' => 'required|min:6|max:100',
            'phone_num' => [ 'required', 'min:10' , 'max:20',Rule::unique('experts')->ignore($id, 'id')],
            'institution_name' => 'required|min:8|max:80',
            'reg_num' => [ 'required', 'min:8' , 'max:50',Rule::unique('experts')->ignore($id, 'id')],
        ]);

        auth()->user()->update($formFields);

        return redirect()->back()->with('message', 'Your details successfully updated.');
    }

    public function editPassword(Request $request){
        return view("dashboard.change_password.index");
    }

    public function updatePassword(Request $request){
        $formFields=$request->validate([
            'old_password' => 'required|max:255',
            'new_password' => [
                'required',
                'string',
                'max:255',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'different:old_password'
            ],
            'confirm_new_password' => 'required|same:new_password'
        ]);

        if (Hash::check($formFields['old_password'], auth()->user()->password)) { 
            auth()->user()->fill([
             'password' => Hash::make($formFields['new_password'])
            ])->save();
            return redirect()->back()->with('message', 'Password changed successfully.');
         
        } 
        return redirect()->back()->with('message', 'Old Password does not match.');
    }
}
