<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\SecondaryEdu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $application_details = Candidate::find($candidate_id)->first();
            return view('admin.requests.view-application')->with(['application_details' => $application_details]);

        }else{
            Auth::logout();
            abort(403);

        }
        
    }
}
