<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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