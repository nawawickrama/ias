<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use PDF;
use Throwable;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived']);
    }

    public function pending_application(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view pending candidates');
       
        if($permission){
            $application_details = Candidate::where('application_status', 2)->get();
            return view('admin.requests.pending-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_application(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view selected candidates');
       
        if($permission){
            $application_details = Candidate::where('application_status', 1)->get();
            return view('admin.requests.approved-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function select_application_by_conditions(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view selected candidates by condition');
       
        if($permission){
            $application_details = Candidate::where('application_status', 3)->get();
            return view('admin.requests.waiting-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function rejected_application(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view rejected candidates');
       
        if($permission){
            $application_details = Candidate::where('application_status', 0)->get();
            return view('admin.requests.rejected-requests')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function appli_view($candidate_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view application');

        if($permission){
            $application_details = Candidate::find($candidate_id);
            return view('admin.requests.view-application')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);

        }
        
    }

    public function appli_download($candidate_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('download application');

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

    public function send_assestment($appli_id)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('send assesment form');
        
        if($permission){
            $application_details = Candidate::find($appli_id);
            return view('admin.assessment.form')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function email_assestment(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('email assesment form');

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

            $data['program'] = $application_details->program;
            $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            $data['address'] = $application_details->address.' '.$application_details->country;
            $data['adimssion'] = $application_details->application_status;
            $data['comment_institute'] = $application_details->comment_institute;
            $data['status_date'] = $application_details->status_date;

            $pdf = PDF::loadView('admin.assessment.pdf', $data);

            Mail::send('admin.assessment.pdf', $data, function($message)use($pdf, $application_details) {
                $message->to($application_details->email)
                        ->subject('Addmission Details')
                        ->attachData($pdf->output(), "admission.pdf");
            });
            
            return back()->with(['success' => 'succesful.']);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function download_form(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('download assesment form');

        if($permission){
            
            $appli_id = request('appli_id');
            $comments = request('comments');
            $addmission = request('addmission');

            $application_details = Candidate::find($appli_id);

            try{
                $application_details->update([
                    'application_status' => $addmission,
                    'comment_institute' => $comments,
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


            $pdf = PDF::loadView('admin.assessment.pdf', $data);
            return $pdf->download($application_details->name.'_'.time().'.pdf');
            
            return back()->with(['success' => 'succesful.']);


        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function download_form_by_approve(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('download assesment form');

        if($permission){
            
            $appli_id = request('appli_id');

            $application_details = Candidate::find($appli_id);

            $data['program'] = $application_details->program;
            $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            $data['address'] = $application_details->address.' '.$application_details->country;
            $data['adimssion'] = $application_details->application_status;
            $data['comment_institute'] = $application_details->comment_institute;


            $pdf = PDF::loadView('admin.assessment.pdf', $data);
            return $pdf->download($application_details->name.'_'.time().'.pdf');
            
            return back()->with(['success' => 'succesful.']);


        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function convert_pending(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('application convert to pending');

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

    public function send_email_page(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('send email');

        if($permission){
            
            return view('admin.mail.send-mail');
        
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function send_email(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('send email');

        if($permission){
            
            $subject = request('subject');
            $data = request('body');
            $email = request('email');

            try{
                Mail::to($email)->send( new sendEmail($data, $subject));

            }catch(Throwable $e){
                // dd($e);
                return back()->with(['error' => 'Email send failed', 'error_type'=> 'error']);
            }
            
            return back()->with(['success' => 'succesful.']);

        
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function email_button(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('send email');

        if($permission){
        
            $email_add = request('email');
            return view('admin.mail.send-mail')->with(['email_add' => $email_add]);
        
        }else{
            Auth::logout();
            abort(403);
        }

    }
    
}
