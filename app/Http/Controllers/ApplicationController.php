<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Candidate;
use App\Models\Cpf;
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
        $permission = $user->can('pending-request.view');

        if($permission){

            $cpf_details = Cpf::where('application_status', 2);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->get();
            return view('admin.requests.pending-requests')->with(['cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('selected-request.view');

        if($permission){
            $cpf_details = Cpf::where('application_status', 1);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->get();
            return view('admin.requests.approved-requests')->with(['cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_cpf_by_conditions(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('selected-under-condition-request.view');

        if($permission){

            $cpf_details = Cpf::where('application_status', 3);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->get();
            return view('admin.requests.waiting-requests')->with(['cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function rejected_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('rejected-request.view');

        if($permission){
            $cpf_details = Cpf::where('application_status', 0);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->get();
            return view('admin.requests.rejected-requests')->with(['cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function cpf_view($cpf_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('cpf.view');

        if($permission){
            $cpf_details = Cpf::where('cpf_id', $cpf_id);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->first();

            $candidate = $cpf_details->candidate;

            $agent = Agent::find($cpf_details->agent_id)->user ?? '';

            $country =$candidate->countryInfo->nicename;
            $nationality = $candidate->nationalityInfo->nicename;
            $program = $cpf_details->course;

            return view('admin.requests.view-application')->with(['nationality' => $nationality, 'candidate' => $candidate, 'agent' => $agent, 'country' => $country, 'program' => $program, 'cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);

        }

    }

    public function cpf_download($cpfId)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('cpf.download');

        if($permission){
            $cpf_details = Cpf::where('cpf_id', $cpfId);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->first();

            $sec_school = $cpf_details->sec_sch;
            $vacational = $cpf_details->vocational_t;
            $higher_edu = $cpf_details->higher_edu;
            $work_exp = $cpf_details->work_exp;

            $program = $cpf_details->course;
            $candidate = $cpf_details->candidate;
            $country =$candidate->countryInfo->nicename;
            $nationality =$candidate->nationalityInfo->nicename;



            return view('admin.requests.download-application')->with(['nationality' => $nationality, 'country' => $country, 'program' => $program, 'candidate' => $candidate, 'cpf_details' => $cpf_details, 'sec_school' => $sec_school, 'vacational' => $vacational, 'higher_edu' => $higher_edu, 'work_exp' => $work_exp]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function send_assestment_form($cpfId)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assestment-form.download');

        if($permission){
            $cpf_details = Cpf::where('cpf_id', $cpfId);

            if($user->hasRole('Agent')){
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $cpf_details = $cpf_details->where('agent_id', $agent_id);
            }

            $cpf_details = $cpf_details->first();
            return view('admin.assessment.form')->with(['cpf_details' => $cpf_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function email_assestment_form(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assestment-form.download');

        if($permission){

            $cpf_id = request('appli_id');
            $comments = request('comments');
            $addmission = request('addmission');
            $email_method = request('email_method');

            $cpf_details = Cpf::find($cpf_id);
            $candidate = $cpf_details->candidate;
            $program = $cpf_details->course;

            try{
                $cpf_details->update([
                    'application_status' => $addmission,
                    'comment_institute' => $comments,
                    'status_date' => date('Y-m-d'),
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Selection Failed', 'error_type' => 'error']);
            }

            $data['program'] = $program->course_code;
            $data['name'] = $candidate->first_name.' '.$candidate->sur_name;
            $data['address'] = $candidate->address.' '.$candidate->country;
            $data['adimssion'] = $cpf_details->application_status;
            $data['comment_institute'] = $comments;
            $data['status_date'] = $cpf_details->status_date;

            $pdf = PDF::loadView('admin.assessment.email', $data);

            if($email_method == 1){
                Mail::send('admin.assessment.email', $data, function($message)use($pdf, $candidate) {
                    $message->to($candidate->email)
                            ->subject('Addmission Details')
                            ->attachData($pdf->output(), "admission.pdf");
                });
            }elseif($email_method == 2){
                if($cpf_details->agent_id != null){
                    $agent_email = Agent::find($cpf_details->agent_id)->agent_email;
                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email) {
                        $message->to($agent_email)
                                ->subject('Addmission Details')
                                ->attachData($pdf->output(), "admission.pdf");
                    });
                }else{
                    back()->with(['error' => 'No agent found!' , 'error_type' => 'warning']);
                }

            }elseif($email_method == 3){
                if($cpf_details->agent_id != null){
                    $agent_email = Agent::find($cpf_details->agent_id)->agent_email;
                    $st_mail = $candidate->email;
                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email, $st_mail) {
                        $message->to($agent_email)
                                ->cc($st_mail)
                                ->subject('Addmission Details')
                                ->attachData($pdf->output(), "admission.pdf");
                    });
                }else{

                    Mail::send('admin.assessment.email', $data, function($message)use($pdf, $candidate) {
                        $message->to($candidate->email)
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

    public function email_assestment_form_by_button(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assestment-form.email');

        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $cpf_id = request('appli_id');
        $email_method = request('email_method');

        $cpf_details = Cpf::find($cpf_id);
        $candidate = $cpf_details->candidate;
        $program = $cpf_details->course;

        $data['program'] = $program->course_code;
        $data['name'] = $candidate->first_name.' '.$candidate->sur_name;
        $data['address'] = $candidate->address.' '.$candidate->country;
        $data['adimssion'] = $cpf_details->application_status;
        $data['comment_institute'] = $cpf_details->comment_institute;
        $data['status_date'] = $cpf_details->status_date;

        $pdf = PDF::loadView('admin.assessment.email', $data);

        if($email_method == 1){
            Mail::send('admin.assessment.email', $data, function($message)use($pdf, $candidate) {
                $message->to($candidate->email)
                        ->subject('Addmission Details')
                        ->attachData($pdf->output(), "$candidate->first_name"."_".$candidate->sur_name."_assesment.pdf");
            });
        }elseif($email_method == 2){
            if($cpf_details->agent_id != null){
                $agent_email = Agent::find($cpf_details->agent_id)->agent_email;
                Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email, $candidate) {
                    $message->to($agent_email)
                            ->subject('Addmission Details')
                            ->attachData($pdf->output(), "$candidate->first_name"."_".$candidate->sur_name."_assesment.pdf");
                });
            }else{
                back()->with(['error' => 'No agent found!' , 'error_type' => 'warning']);
            }

        }elseif($email_method == 3){
            if($cpf_details->agent_id != null){
                $agent_email = Agent::find($cpf_details->agent_id)->agent_email;
                $st_mail = $candidate->email;
                Mail::send('admin.assessment.email', $data, function($message)use($pdf, $agent_email, $st_mail, $candidate) {
                    $message->to($agent_email)
                            ->cc($st_mail)
                            ->subject('Addmission Details')
                            ->attachData($pdf->output(), "$candidate->first_name"."_".$candidate->sur_name."_assesment.pdf");
                });
            }else{

                Mail::send('admin.assessment.email', $data, function($message)use($pdf, $candidate) {
                    $message->to($candidate->email)
                            ->subject('Addmission Details')
                            ->attachData($pdf->output(), "$candidate->first_name"."_".$candidate->sur_name."_assesment.pdf");
                });


                Session::put(['error' => 'Student email sent but there is not agent for this application.' , 'error_type' => 'warning']);
                return back();
            }
        }

        Session::put('success', 'Send Successful');
        return back();
    }

    public function download_assestment_form(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assestment-form.download');

        if($permission){

            $cpf_id = request('appli_id');
            $comments = request('comments');
            $addmission = request('addmission');

            $cpf_details = Cpf::find($cpf_id);

            try{
                $cpf_details->update([
                    'application_status' => $addmission,
                    'comment_institute' => $comments,
                    'status_date' => date('Y-m-d'),
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Selection Failed', 'error_type' => 'error']);
            }

            return view('admin.assessment.pdf')->with(['cpf_details' => $cpf_details]);
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function download_assestment_form_by_approve(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('assestment-form.download');

        if($permission){

            $cpf_id = request('appli_id');

            $cpf_details = Cpf::find($cpf_id);

            return view('admin.assessment.pdf')->with(['cpf_details' => $cpf_details]);


        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function cpf_rollback(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('selected-under-condition-request.rollback') || $user->can('rejected-request.rollback');

        if($permission){

            $cpf_id = request('appli_id');
            $cpf_details = cpf::find($cpf_id);

            try{
                $cpf_details->update([
                    'application_status' => '2'
                ]);

            }catch(Throwable $e){
                return back()->with(['error' => 'Application Rollback Failed', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'succesful.']);

        }else{
            Auth::logout();
            abort(403);
        }
    }

}
