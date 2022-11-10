<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    function showVerificationNotice() {
        return view('auth.verify-email');
    }

    function verify(EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/');
    }

    function sendLink(Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    }
}
