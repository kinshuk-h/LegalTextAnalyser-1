<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ParagraphController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// Email Verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Other Routes

Route::get('/', function () {
    return view('home');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard/tasks', function () {
    return view('db.dbtasks');
})->middleware(['auth', 'verified']);

Route::get('/dashboard/stats', function () {
    return view('db.dbstats');
})->middleware(['auth', 'verified']);

Route::get('/register', [ExpertController::class, 'create'])->middleware('guest');
Route::post('/expert', [ExpertController::class, 'store'])->middleware('guest');

Route::get('/login', [ExpertController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [ExpertController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [ExpertController::class, 'logout'])->middleware(['auth', 'verified']);

//labeling
Route::get('/paragraph', [ParagraphController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/paragraph/allocate', [ParagraphController::class, 'create'])->middleware(['auth', 'verified']);
Route::post('/paragraph/label', [ParagraphController::class, 'store'])->middleware(['auth', 'verified']);
Route::post('/paragraph/bypass', [ParagraphController::class, 'update'])->middleware(['auth', 'verified']);