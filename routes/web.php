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

//Application Admin
Route::get('/admin/pending-requests',[ApplicationController::class, 'pending_application'])->name('pending-requests');
Route::get('/admin/application/view/{candyId}',[ApplicationController::class, 'appli_view'])->name('view-application');
Route::view('/admin/approved-requests','admin.requests.approved-requests')->name('approved-requests');
Route::view('/admin/waiting-requests','admin.requests.waiting-requests')->name('waiting-requests');
Route::view('/admin/rejected-requests','admin.requests.rejected-requests')->name('rejected-requests');
Route::view('/admin/download-application','admin.requests.download-application')->name('download-application');
Route::view('/admin/view-application','admin.requests.view-application')->name('view-application');

//Assesment Form Admin
Route::view('/admin/assessment-form','admin.assessment.form')->name('assessment-form');
Route::view('/admin/assessment-form-pdf','admin.assessment.pdf')->name('assessment-form-pdf');
Route::view('/admin/assessment-form-pdf','admin.assessment.pdf')->name('assessment-form-pdf');

//Settings Admin
Route::view('/admin/smtp','admin.settings.smtp')->name('smtp');
Route::view('/admin/user-settings','admin.settings.user')->name('user-settings');
//Landing
Route::view('/','landing.home');


//Candidate form
Route::view('/','landing.home');
Route::post('/', [CandidareController::class, 'reg_candi'])->name('reg_candi');
