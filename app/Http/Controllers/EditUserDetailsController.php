<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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

    public function updatePassword(Request $request){
        $formFields=$request->validate([
            'old_password' => 'required|min:8|max:255',
            'new_password' => 'required|min:8|max:255|different:old_password',
            'confirm_new_password' => 'required|same:new_password'
        ]);

        if (Hash::check($formFields['old_password'], auth()->user()->password)) { 
            auth()->user()->fill([
             'password' => Hash::make($formFields['new_password'])
            ])->save();
            return redirect()->back()->with('message', 'Password changed successfully.');
         
        } 
        return redirect()->back()->with('message', 'Password does not match.');
    }
}
