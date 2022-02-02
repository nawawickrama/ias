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

//Admin Dashboard
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Application 
Route::get('/admin/pending-requests', [ApplicationController::class, 'pending_cpf'])->name('pending-requests');
Route::get('/admin/application/view/{candyId}', [ApplicationController::class, 'cpf_view'])->name('view-application');
Route::get('/admin/application/download/{cpfId}', [ApplicationController::class, 'cpf_download'])->name('download-application');

Route::get('/admin/approved-requests', [ApplicationController::class, 'select_cpf'])->name('approved-requests');
Route::get('/admin/waiting-requests', [ApplicationController::class, 'select_cpf_by_conditions'])->name('waiting-requests');
Route::get('/admin/rejected-requests', [ApplicationController::class, 'rejected_cpf'])->name('rejected-requests');

Route::post('/admin/covert-pending', [ApplicationController::class, 'cpf_rollback'])->name('convert_pending');


//Admin Assesment Form 
Route::get('/admin/assessment-form/{cpfId}', [ApplicationController::class, 'send_assestment_form'])->name('send_assessment_form');
Route::post('/admin/assessment-email/', [ApplicationController::class, 'email_assestment_form'])->name('email_assessment_form');
Route::post('/admin/assessment-down/', [ApplicationController::class, 'download_assestment_form'])->name('download_assessment_form');
Route::post('/admin/assessment-down-approve/', [ApplicationController::class, 'download_assestment_form_by_approve'])->name('download_assessment_form_by_approve');

//Admin Settings 
//SMTP
Route::get('/admin/smtp', [SettingControler::class, 'smtp_page'])->name('smtp');
Route::post('/admin/smtp', [SettingControler::class, 'set_smtp'])->name('set_smtp');

//User Accoutn
Route::get('/admin/user-settings', [ProfileController::class, 'user'])->name('user-settings');
Route::post('/admin/user-settings', [ProfileController::class, 'add_user'])->name('add-user');
Route::post('/admin/user-status', [ProfileController::class, 'active_inactive'])->name('active_inactive');

//Admin Profile
Route::view('/admin/profile', 'admin.profile.profile')->name('profile');

//Admin Email
Route::get('/admin/send-mail', [EmailController::class, 'send_email_get'])->name('send-mail');
Route::post('/admin/send-mail', [EmailController::class, 'send_email_post'])->name('send-mail-post');
Route::post('/admin/button-mail', [EmailController::class, 'email_button'])->name('email_button');

//Landing
Route::get('/', [HomeController::class, 'index']);

//cpf form
Route::get('/cpf', [CpfController::class, 'cpf'])->name('cpf');
Route::post('/cpf', [CpfController::class, 'cpf_post'])->name('cpf_post');

//Agent CPF
Route::get('/reg_cpf/{reference_no}', [CpfController::class, 'agent_cpf'])->name('agent_cpf');


//Agent
Route::get('/agents', [AgentController::class, 'agent_page'])->name('agents');
Route::post('/agents', [AgentController::class, 'add_agents'])->name('add_agents');
Route::post('/admin/agents-update', [AgentController::class, 'edit_agents'])->name('edit_agents');
Route::post('/admin/agents-active_deactive', [AgentController::class, 'act_dea_agents'])->name('act_dea_agents');

//user management
Route::get('/admin/role-management', [SettingControler::class, 'role_get'])->name('role_get');
Route::post('/admin/role-management', [SettingControler::class, 'role_post'])->name('role_post');

//permission management
Route::get('/admin/permission-management', [SettingControler::class, 'permission_role_get'])->name('permission_role_get');
Route::post('/admin/permission-management', [SettingControler::class, 'permission_role_post'])->name('permission_role_post');

//ajax
//Pending indicator
Route::post('/ajax/pending', [CpfController::class, 'check_pending_cpf'])->name('check_pending_cpf');

//select country and get agents
Route::post('ajax/country-agent', [AgentController::class, 'country_agent'])->name('country_agent');

//agent name and email
Route::post('/ajax/name-email-agent', [AgentController::class, 'name_email'])->name('name_email_ajax');
