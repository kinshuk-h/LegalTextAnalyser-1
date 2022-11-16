<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\EditUserDetailsController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\DashboardTasksManageController;

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
//Routes for everyone (guest or authenticated)
Route::get('/', function () {   return view('home');    });
Route::get('/aboutus', function () {    return view('aboutus'); });

// logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => 'guest'], function () {
    // login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // registration
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    //Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::group(['prefix' => 'email'], function() {
    // Email Verification
    Route::get('/verify', [EmailVerificationController::class,'showVerificationNotice'])->middleware('auth')->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [EmailVerificationController::class,'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/verification-notification', [EmailVerificationController::class,'sendLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'paragraph'], function() {
        //labeling paragraph
        Route::get('/', [AnnotationController::class, 'annotationIndex']);
        Route::get('/allocate', [AnnotationController::class, 'allocateParagraph']);
        Route::post('/label', [AnnotationController::class, 'storeLabels']);
        Route::post('/bypass', [AnnotationController::class, 'bypassParagraph']);
    });

    Route::group(['prefix' => 'dashboard'], function() {
        // Route::get('/', function () {  return view('dashboard'); });

        Route::group(['prefix' => 'profile'], function() {
            Route::get('/', [EditUserDetailsController::class, 'editDetails']);
            Route::put('/', [EditUserDetailsController::class, 'updateDetails']);
        });

        Route::group(['prefix' => 'change-password'], function() {
            Route::get('/', [EditUserDetailsController::class, 'editPassword']);
            Route::put('/', [EditUserDetailsController::class, 'updatePassword']);
        });

        Route::group(['prefix' => 'tasks'], function() {
            Route::get('/', [DashboardTasksManageController::class, 'showAllTasks']);
            Route::get('/filter', [DashboardTasksManageController::class, 'showFilteredTasks']);
            Route::get('/search', [DashboardTasksManageController::class, 'showTasksBySearch']);
        });
        Route::get('/stats', function () {  return view('dashboard.activity.index');  });
    });
});