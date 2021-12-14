<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\SecondaryEdu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
