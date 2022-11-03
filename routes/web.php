<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\ParagraphController;

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

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard/tasks', function () {
    return view('db.dbtasks');
})->middleware('auth');

Route::get('/dashboard/stats', function () {
    return view('db.dbstats');
})->middleware('auth');

Route::get('/register', [ExpertController::class, 'create'])->middleware('guest');
Route::post('/expert', [ExpertController::class, 'store']);

Route::get('/login', [ExpertController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [ExpertController::class, 'authenticate']);

Route::post('/logout', [ExpertController::class, 'logout'])->middleware('auth');

//labeling
Route::get('/paragraph', [ParagraphController::class, 'index'])->middleware('auth');
Route::get('/paragraph/allocate', [ParagraphController::class, 'create'])->middleware('auth');
Route::post('/paragraph/label', [ParagraphController::class, 'store'])->middleware('auth');