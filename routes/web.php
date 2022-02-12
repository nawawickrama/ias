<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CpfController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
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

//Dashboard
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Application 
Route::get('/pending-requests', [ApplicationController::class, 'pending_cpf'])->name('pending-requests');
Route::get('/application/view/{candyId}', [ApplicationController::class, 'cpf_view'])->name('view-application');
Route::get('/application/download/{cpfId}', [ApplicationController::class, 'cpf_download'])->name('download-application');

Route::get('/approved-requests', [ApplicationController::class, 'select_cpf'])->name('approved-requests');
Route::get('/waiting-requests', [ApplicationController::class, 'select_cpf_by_conditions'])->name('waiting-requests');
Route::get('/rejected-requests', [ApplicationController::class, 'rejected_cpf'])->name('rejected-requests');

Route::post('/covert-pending', [ApplicationController::class, 'cpf_rollback'])->name('convert_pending');


//Assesment Form 
Route::get('/assessment-form/{cpfId}', [ApplicationController::class, 'send_assestment_form'])->name('send_assessment_form');
Route::post('/assessment-email/', [ApplicationController::class, 'email_assestment_form'])->name('email_assessment_form');
Route::post('/assessment-email-button/', [ApplicationController::class, 'email_assestment_form_by_button'])->name('email_assestment_form_by_button');
Route::post('/assessment-down/', [ApplicationController::class, 'download_assestment_form'])->name('download_assessment_form');
Route::post('/assessment-down-approve/', [ApplicationController::class, 'download_assestment_form_by_approve'])->name('download_assessment_form_by_approve');

/*Settings */
//SMTP
Route::get('/smtp-settings', [SettingControler::class, 'smtp_page'])->name('smtp');
Route::post('/smtp-settings', [SettingControler::class, 'set_smtp'])->name('set_smtp');

//Course Settings
Route::get('/courses-view', [SettingControler::class, 'course_get'])->name('course_get');
Route::post('/courses-view', [SettingControler::class, 'course_post'])->name('course_add');


//User Accoutn
Route::get('/user-settings', [ProfileController::class, 'user'])->name('user-settings');
Route::post('/user-settings', [ProfileController::class, 'add_user'])->name('add-user');
Route::post('/user-status', [ProfileController::class, 'active_inactive'])->name('active_inactive');

//Profile
Route::view('/profile', 'admin.profile.profile')->name('profile');

//Email
Route::get('/send-mail', [EmailController::class, 'send_email_get'])->name('send-mail');
Route::post('/send-mail', [EmailController::class, 'send_email_post'])->name('send-mail-post');
Route::post('/button-mail', [EmailController::class, 'email_button'])->name('email_button');

//Landing
Route::get('/', [HomeController::class, 'index']);

//cpf form
Route::get('/direct_cpf', [CpfController::class, 'cpf'])->name('cpf');
Route::post('/direct_cpf', [CpfController::class, 'cpf_post'])->name('cpf_post');

//Agent CPF
Route::get('/reg_cpf/{reference_no}', [CpfController::class, 'agent_cpf'])->name('agent_cpf');


//Agent
Route::get('/agents', [AgentController::class, 'agent_page'])->name('agents');
Route::post('/agents', [AgentController::class, 'add_agents'])->name('add_agents');
Route::post('/agents-update', [AgentController::class, 'edit_agents'])->name('edit_agents');
Route::post('/agents-active_deactive', [AgentController::class, 'act_dea_agents'])->name('act_dea_agents');

//user management
Route::get('/role-management', [SettingControler::class, 'role_get'])->name('role_get');
Route::post('/role-management', [SettingControler::class, 'role_post'])->name('role_post');

//permission management
Route::get('/permission-management', [SettingControler::class, 'permission_role_get'])->name('permission_role_get');
Route::post('/permission-management', [SettingControler::class, 'permission_role_post'])->name('permission_role_post');

//ajax==========================
//Pending indicator
Route::post('/ajax/pending', [CpfController::class, 'check_pending_cpf'])->name('check_pending_cpf');

//select country and get agents
Route::post('ajax/country-agent', [AgentController::class, 'country_agent'])->name('country_agent');

//agent name and email
Route::post('/ajax/name-email-agent', [AgentController::class, 'name_email'])->name('name_email_ajax');

//permission fill
Route::post('/ajax/role_and_permission', [SettingControler::class, 'fill_permission'])->name('fill_permission');


//========================AYESH ADDED UI===========================
//Admin - leads
Route::view('/admin/pending-leads','admin.leads.pending-leads')->name('pending-leads');