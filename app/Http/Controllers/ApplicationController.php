<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Throwable;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function pending_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('pending-candidates.view');
       
        if($permission){
            $application_details = Candidate::where('application_status', 2)->get();
            return view('admin.requests.pending-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('selected-candidates.view');
       
        if($permission){
            $application_details = Candidate::where('application_status', 1)->get();
            return view('admin.requests.approved-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_cpf_by_conditions(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('selected-candidates-under-condition.view');
       
        if($permission){
            $application_details = Candidate::where('application_status', 3)->get();
            return view('admin.requests.waiting-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function rejected_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('rejected-candidates.view');
       
        if($permission){
            $application_details = Candidate::where('application_status', 0)->get();
            return view('admin.requests.rejected-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function cpf_view($candidate_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('application.view');

        if($permission){
            $application_details = Candidate::find($candidate_id);
            return view('admin.requests.view-application')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);

        }
        
    }

    public function cpf_download($candidate_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('application-download');

        if($permission){
            $application_details = Candidate::find($candidate_id);
            $sec_school = Candidate::find($application_details->candidate_id)->sec_sch;
            $vacational = Candidate::find($application_details->candidate_id)->vocational_t;
            $higher_edu = Candidate::find($application_details->candidate_id)->higher_edu;
            $work_exp = Candidate::find($application_details->candidate_id)->work_exp;

            // $pdf = PDF::loadView('admin.requests.download-application', ['application_details' => $application_details, 'sec_school' => $sec_school, 'vacational' => $vacational, 'higher_edu' => $higher_edu, 'work_exp' => $work_exp]);
            // return $pdf->download('invoice.pdf');
            return view('admin.requests.download-application')->with(['application_details' => $application_details, 'sec_school' => $sec_school, 'vacational' => $vacational, 'higher_edu' => $higher_edu, 'work_exp' => $work_exp]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function send_assestment_form($appli_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assesment-form-send');
        
        if($permission){
            $application_details = Candidate::find($appli_id);
            return view('admin.assessment.form')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function email_assestment_form(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assesment-form-email');

        if($permission){
            
            $appli_id = request('appli_id');
            $comments = request('comments');
            $addmission = request('addmission');
            $email_method = request('email_method');

            $application_details = Candidate::find($appli_id);

            try{
                $application_details->update([
                    'application_status' => $addmission,
                    'comment_institute' => $comments,
                    'status_date' => date('Y-m-d'),
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Selection Failed', 'error_type' => 'error']);
            }

            $data['program'] = $application_details->program;
            $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            $data['address'] = $application_details->address.' '.$application_details->country;
            $data['adimssion'] = $application_details->application_status;
            $data['comment_institute'] = $application_details->comment_institute;
            $data['status_date'] = $application_details->status_date;

            $pdf = PDF::loadView('admin.assessment.email', $data);

            if($email_method == 1){
                Mail::send('admin.assessment.email', $data, function($message)use($pdf, $application_details) {
                    $message->to($application_details->email)
                            ->subject('Addmission Details')
                            ->attachData($pdf->output(), "admission.pdf");
                });
            }elseif($email_method == 2){
                if($application_details->agent_id != null){
                    $agent_email = Agent::find($application_details->agent_id)->agent_email;
                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email) {
                        $message->to($agent_email)
                                ->subject('Addmission Details')
                                ->attachData($pdf->output(), "admission.pdf");
                    });
                }else{
                    back()->with(['error' => 'No agent found!' , 'error_type' => 'warning']);
                }
               
            }elseif($email_method == 3){
                if($application_details->agent_id != null){
                    $agent_email = Agent::find($application_details->agent_id)->agent_email;
                    $st_mail = $application_details->email;
                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email, $st_mail) {
                        $message->to($agent_email)
                                ->cc($st_mail)
                                ->subject('Addmission Details')
                                ->attachData($pdf->output(), "admission.pdf");
                    });
                }else{

                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $application_details) {
                        $message->to($application_details->email)
                                ->subject('Addmission Details')
                                ->attachData($pdf->output(), "admission.pdf");
                    });


                    Session::put(['error' => 'Student email sent but there is not agent for this application.' , 'error_type' => 'warning']);
                    return Redirect::route('pending-requests');
                }
            }
            
            Session::put('success', 'Send Successful');
            return Redirect::route('pending-requests');

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function download_assestment_form(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assesment-form-download');

        if($permission){
            
            $appli_id = request('appli_id');
            $comments = request('comments');
            $addmission = request('addmission');

            $application_details = Candidate::find($appli_id);

            try{
                $application_details->update([
                    'application_status' => $addmission,
                    'comment_institute' => $comments,
                    'status_date' => date('Y-m-d'),
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Selection Failed', 'error_type' => 'error']);
            }
            // $data['program'] = $application_details->program;
            // $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            // $data['address'] = $application_details->address.' '.$application_details->country;
            // $data['adimssion'] = $application_details->application_status;
            // $data['comment_institute'] = $application_details->comment_institute;
            // $data['status_date'] = $application_details->status_date;


            // $pdf = PDF::loadView('admin.assessment.pdf', $data);
            // return $pdf->download($application_details->name.'_'.time().'.pdf');
            return view('admin.assessment.pdf')->with(['application_details' => $application_details]);


            
            return back()->with(['success' => 'succesful.']);


        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function download_assestment_form_by_approve(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assesment-form-download');

        if($permission){
            
            $appli_id = request('appli_id');

            $application_details = Candidate::find($appli_id);

            // $data['program'] = $application_details->program;
            // $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            // $data['address'] = $application_details->address.' '.$application_details->country;
            // $data['adimssion'] = $application_details->application_status;
            // $data['comment_institute'] = $application_details->comment_institute;
            // $data['status_date'] = $application_details->status_date;


            // $pdf = PDF::loadView('admin.assessment.pdf', $data);
            // return $pdf->download($application_details->name.'_'.time().'.pdf');
            
            // return back()->with(['success' => 'succesful.']);

            return view('admin.assessment.pdf')->with(['application_details' => $application_details]);


        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function cpf_back_to_pending(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('application-reverse');

        if($permission){

            $appli_id = request('appli_id');
            $application_details = Candidate::find($appli_id);
            
            try{
                $application_details->update([
                    'application_status' => '2'
                ]);

            }catch(Throwable $e){
                return back()->with(['error' => 'Application Reverse Failed', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'succesful.']);

        }else{
            Auth::logout();
            abort(403);
        }
    }
    
}
