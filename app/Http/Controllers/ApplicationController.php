<?php

namespace App\Http\Controllers;

use App\Mail\AddUser;
use App\Models\Candidate;
use App\Models\SecondaryEdu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $permission = $user->can('view application');

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
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Selection Failed', 'error_type' => 'error']);
            }
            $data['program'] = $application_details->program;
            $data['name'] = $application_details->first_name.' '.$application_details->sur_name;
            $data['address'] = $application_details->address.' '.$application_details->country;
            $data['adimssion'] = $application_details->application_status;
            $data['comment_institute'] = $application_details->comment_institute;


            // $pdf = PDF::loadView('admin.assessment.pdf', $data);
            // $pdf = PDF::loadView('admin.home');

            // Mail::send('admin.assessment.pdf', $data, function($message)use($pdf, $application_details) {
            //     $message->to($application_details->email)
            //             ->subject('Addmission Details')
            //             ->attachData($pdf->output(), "admission.pdf");
            // });
            
            
            return back()->with(['success']);

        }else{
            Auth::logout();
            abort(403);
        }
    }
}
