<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidareController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingControler;
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

//Admin Application 
Route::get('/admin/pending-requests',[ApplicationController::class, 'pending_application'])->name('pending-requests');
Route::get('/admin/application/view/{candyId}',[ApplicationController::class, 'appli_view'])->name('view-application');
Route::get('/admin/application/download/{candyId}',[ApplicationController::class, 'appli_download'])->name('download-application');


Route::view('/admin/approved-requests','admin.requests.approved-requests')->name('approved-requests');
Route::view('/admin/waiting-requests','admin.requests.waiting-requests')->name('waiting-requests');
Route::view('/admin/rejected-requests','admin.requests.rejected-requests')->name('rejected-requests');



//Admin Assesment Form 
Route::view('/admin/assessment-form','admin.assessment.form')->name('assessment-form');
Route::view('/admin/assessment-form-pdf','admin.assessment.pdf')->name('assessment-form-pdf');

//Admin Settings 
    //SMTP
    Route::get('/admin/smtp',[SettingControler::class, 'smtp_page'])->name('smtp');
    Route::post('/admin/smtp',[SettingControler::class, 'set_smtp'])->name('set_smtp');

//User Accoutn
Route::get('/admin/user-settings', [ProfileController::class, 'user'])->name('user-settings');
Route::post('/admin/user-settings', [ProfileController::class, 'add_user'])->name('add-user');

Route::view('/admin/approved-requests','admin.requests.approved-requests')->name('approved-requests');
Route::view('/admin/waiting-requests','admin.requests.waiting-requests')->name('waiting-requests');
Route::view('/admin/rejected-requests','admin.requests.rejected-requests')->name('rejected-requests');

//Admin Profile
Route::view('/admin/profile','admin.profile.profile')->name('profile');

//Admin Email
Route::view('/admin/send-mail','admin.mail.send-mail')->name('send-mail');
//Landing
Route::view('/','landing.home');
Route::post('/', [CandidareController::class, 'reg_candi'])->name('reg_candi');
