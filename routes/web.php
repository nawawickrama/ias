<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CpfController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingControler;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GenaralController;
use \App\Http\Controllers\Auth\LoginController;
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
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('home');

//Application
Route::get('/pending-requests', [ApplicationController::class, 'pending_cpf'])->name('pending-requests');
Route::get('/application/view/{candyId}', [ApplicationController::class, 'cpf_view'])->name('view-application');
Route::get('/application/download/{cpfId}', [ApplicationController::class, 'cpf_download'])->name('download-application');

Route::get('/approved-requests', [ApplicationController::class, 'select_cpf'])->name('approved-requests');
Route::get('/waiting-requests', [ApplicationController::class, 'select_cpf_by_conditions'])->name('waiting-requests');
Route::get('/rejected-requests', [ApplicationController::class, 'rejected_cpf'])->name('rejected-requests');

Route::post('/covert-pending', [ApplicationController::class, 'cpf_rollback'])->name('convert_pending');


//Assessment Form
Route::post('/assessment-form/', [ApplicationController::class, 'send_assestment_form'])->name('send_assessment_form');
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
Route::post('/courses-status-change', [SettingControler::class, 'statusChange'])->name('statusChange');


//User Account
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
Route::post('/agents-active_deactivate', [AgentController::class, 'act_dea_agents'])->name('act_dea_agents');

//user management
Route::get('/role-management', [SettingControler::class, 'role_get'])->name('role_get');
Route::post('/role-management', [SettingControler::class, 'role_post'])->name('role_post');

//permission management
Route::get('/permission-management', [SettingControler::class, 'permission_role_get'])->name('permission_role_get');
Route::post('/permission-management', [SettingControler::class, 'permission_role_post'])->name('permission_role_post');


//leads====================
Route::get('/pending-leads', [LeadController::class, 'lead_pending'])->name('pending_lead');
Route::post('/assign-leads', [LeadController::class, 'assgn_leads_to_agent'])->name('assgn_leads_to_agent');
Route::post('/delete-leads', [LeadController::class, 'leade_delete'])->name('leade_delete');
Route::get('/my-leads', [LeadController::class, 'my_leads'])->name('my_leads');
Route::get('/all-leads', [LeadController::class, 'all_leads'])->name('all_leads');

//assign myself
Route::post('/lead-assign-my-self', [LeadController::class, 'assign_my_self'])->name('assign_my_self');

Route::post('/leads-create', [LeadController::class, 'create'])->name('lead_create');
Route::post('/leads-edit', [LeadController::class, 'edit_lead'])->name('edit_lead');

Route::post('/make-lead-as-potential', [LeadController::class, 'lead_convert_to_potential'])->name('lead_convert_to_potential');
Route::get('/admin/potential-leads', [LeadController::class, 'potential_lead'])->name('potential_lead');

//lead CPF
Route::post('/potential-lead-cpf-send', [EmailController::class, 'send_potential_liad_cpf'])->name('send_potential_liad_cpf');
Route::get('/lead-cpf-form/{lead_random_number}', [CpfController::class, 'lead_cpf_form'])->name('lead_cpf_form');
Route::post('/set-reminder', [LeadController::class, 'setReminder'])->name('setReminder');
Route::post('/view-lead-activity-log', [LeadController::class, 'viewLeadActivity'])->name('viewLeadActivity');

//ajax==========================
//select country and get agents
Route::post('/ajax/country-agent', [AgentController::class, 'country_agent'])->name('country_agent');

//agent name and email
Route::post('/ajax/name-email-agent', [AgentController::class, 'name_email'])->name('name_email_ajax');

//permission fill
Route::post('/ajax/role_and_permission', [SettingControler::class, 'fill_permission'])->name('fill_permission');

//get document details
Route::post('/ajax/get_doc_details', [DocumentController::class, 'getDocumentDetails'])->name('getDocumentDetails');

//notification
Route::post('/ajax/notification', [NotificationController::class, 'notifications'])->name('notifications');
Route::post('/ajax/notification-count', [NotificationController::class, 'notificationCount'])->name('notificationCount');
Route::get('/ajax/notification/mark_as_read/{notification}', [NotificationController::class, 'mark_as_read_notification'])->name('mark_as_read_notification');

//Pending indicator
Route::post('/ajax/pending', [NotificationController::class, 'indicator'])->name('check_pending_cpf');

//student=======================
Route::get('/student/dashboard', [HomeController::class, 'index'])->name('studentDashboard');
Route::get('/student/information', [StudentController::class, 'studentInformation'])->name('studentInformation');
Route::post('/student/information', [StudentController::class, 'studentInformationPost'])->name('studentInformation');

Route::get('/student/documents', [DocumentController::class, 'candidate_document'])->name('candidateDocument');
Route::post('/student/documents/resubmit', [StudentController::class, 'reUploadDocument'])->name('reUploadDocument');



//potential student
Route::get('/potential-students', [StudentController::class, 'potential_student'])->name('potential-students');
Route::post('/potential-students', [CpfController::class, 'makePotentialStudent'])->name('make-potential');

//login as a ghost
Route::post('/login-as-a-ghost', [GenaralController::class, 'logAsGhost'])->name('logAsGhost');

//Document Setting
Route::get('/document-settings', [SettingControler::class, 'documentSetting'])->name('document-settings');
Route::post('/document-settings', [SettingControler::class, 'documentCourseLink'])->name('document-course-link');
Route::post('/document-settings-status', [SettingControler::class, 'documentCourseStatus'])->name('document-course-status');
Route::view('/student/pending-verification', 'student.wizard.pending-verification')->middleware('auth')->name('pending-verification');
Route::post('/document-add-new', [SettingControler::class, 'addNewDocument'])->name('add-new-document');

Route::get('/document-complete', [DocumentController::class, 'pendingDocument'])->name('document-verification');
Route::post('/document-status-change', [DocumentController::class, 'documentStatusChange'])->name('documentStatusChange');

//send AAF or LGO from admin to candidate
Route::post('/send-forms-to-candidate', [FormController::class, 'sendFormToCandidate'])->name('sendFormToCandidate');

Route::get('/student/aaf', [StudentController::class, 'aaFormPage'])->name('aaf');
Route::post('/student/aaf', [FormController::class, 'submitForm'])->name('submitAAForm');
Route::get('/student/lgo', [StudentController::class, 'LGOFormPage'])->name('lgo');

//approve AAF and LOG from admin
Route::get('/verify-lgo-aaf', [FormController::class, 'formStatusPage'])->name('verify-lgo-aaf');
Route::post('/verify-lgo-aaf', [FormController::class, 'formStatusChange'])->name('verify-lgo-aaf');

//Student Payment Manager
Route::get('/student/payments-manager',[PaymentController::class, 'paymentPage'])->name('payments-manager');
Route::post('/student/make-payment',[PaymentController::class, 'makePayment'])->name('make-payment');
Route::post('/student/status-change-payment',[PaymentController::class, 'changePaymentStatus'])->name('change-payment-status');

Route::get('/admin/payments-manager',[PaymentController::class, 'paymentManager'])->name('admin-payments-manager');

//download forms - student end
Route::post('/student/download/forms', [DocumentController::class, 'downloadForm'])->name('downloadForm');

//Payment receipt
Route::post('/fee-receipt', [PaymentController::class, 'invoice'])->name('invoice');
