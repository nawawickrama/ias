<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CandidareController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingControler;
use App\Mail\newMailw;
use App\Mail\NewUser;
use App\Mail\newUser as MailNewUser;
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

Route::get('/admin/approved-requests',[ApplicationController::class, 'select_application'])->name('approved-requests');
Route::get('/admin/waiting-requests', [ApplicationController::class, 'select_application_by_conditions'])->name('waiting-requests');
Route::get('/admin/rejected-requests', [ApplicationController::class, 'rejected_application'])->name('rejected-requests');

Route::post('/admin/covert-pending', [ApplicationController::class, 'convert_pending'])->name('convert_pending');


//Admin Assesment Form 
Route::get('/admin/assessment-form/{appliId}', [ApplicationController::class, 'send_assestment'])->name('send_assessment_form');
Route::post('/admin/assessment-email/', [ApplicationController::class, 'email_assestment'])->name('email_assessment_form');
Route::post('/admin/assessment-down/', [ApplicationController::class, 'download_form'])->name('download_assessment_form');
Route::post('/admin/assessment-down-approve/', [ApplicationController::class, 'download_form_by_approve'])->name('download_assessment_form_by_approve');

//Admin Settings 
    //SMTP
    Route::get('/admin/smtp',[SettingControler::class, 'smtp_page'])->name('smtp');
    Route::post('/admin/smtp',[SettingControler::class, 'set_smtp'])->name('set_smtp');

    //User Accoutn
    Route::get('/admin/user-settings', [ProfileController::class, 'user'])->name('user-settings');
    Route::post('/admin/user-settings', [ProfileController::class, 'add_user'])->name('add-user');
    Route::post('/admin/user-status', [ProfileController::class, 'active_inactive'])->name('active_inactive');

//Admin Profile
Route::view('/admin/profile','admin.profile.profile')->name('profile');

//Admin Email
Route::get('/admin/send-mail', [ApplicationController::class, 'send_email_page'])->name('send-mail');
Route::post('/admin/send-mail', [ApplicationController::class, 'send_email'])->name('send-mail-post');
Route::post('/admin/button-mail', [ApplicationController::class, 'email_button'])->name('email_button');

//Landing
Route::get('/', function(){ return view('landing.home'); });
Route::post('/', [CandidareController::class, 'reg_candi'])->name('reg_candi');

Route::view('/admin/agents', 'admin.agents.agent')->name('agents');