<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidareController;
use Illuminate\Support\Facades\Auth;
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

//Application
Route::get('/admin/pending-requests',[ApplicationController::class, 'pending_application'])->name('pending-requests');
Route::get('/admin/application/view/{candyId}',[ApplicationController::class, 'appli_view'])->name('view-application');

Route::view('/admin/approved-requests','admin.requests.approved-requests')->name('approved-requests');
Route::view('/admin/waiting-requests','admin.requests.waiting-requests')->name('waiting-requests');
Route::view('/admin/rejected-requests','admin.requests.rejected-requests')->name('rejected-requests');
Route::view('/admin/download-application','admin.requests.download-application')->name('download-application');


//Candidate form
Route::view('/','landing.home');
Route::post('/', [CandidareController::class, 'reg_candi'])->name('reg_candi');