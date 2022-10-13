<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/register', [ExpertController::class, 'create'])->middleware('guest');
Route::post('/expert', [ExpertController::class, 'store']);

Route::get('/login', [ExpertController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [ExpertController::class, 'authenticate']);

Route::post('/logout', [ExpertController::class, 'logout'])->middleware('auth');