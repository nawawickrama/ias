<?php

use Illuminate\Support\Facades\Route;

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


//Authentication
Auth::routes([
    'register' => false,
]);

//Logout
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Admin Dashboard
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/admin/pending-requests','admin.requests.pending-requests')->name('pending-requests');
Route::view('/admin/approved-requests','admin.requests.approved-requests')->name('approved-requests');
Route::view('/admin/rejected-requests','admin.requests.rejected-requests')->name('rejected-requests');
//Landing
Route::view('/','landing.home');