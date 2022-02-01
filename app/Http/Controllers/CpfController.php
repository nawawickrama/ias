<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\Cpf;
use App\Models\HigherEdu;
use App\Models\SecondaryEdu;
use App\Models\VocationalTraining;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\DB;
use Throwable;

class CpfController extends Controller
{
    public function cpf()
    {
        $country = Country::all();
        $agent_details = Agent::where('agent_status', 1)->get();
        return view('landing.home')->with(['agent_details' => $agent_details, 'country' => $country]);
    }


    public function reg_candidates(Request $request)
    {
        $request->validate([
            //cpf
            'program' => 'required',

            //candidate
            'first_name' => 'required',
            'sur_name' => 'required',
            'sex' => 'required',
            'dob' => 'required|date',
            'nationality' => 'required',
            'telephone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip' => 'required',
            'country' => 'required',

            //edu
            'secondary_school' => 'nullable',
            'higher_sec_school' => 'nullable',

            //training
            'v_training_tick' => 'nullable',

            //university
            'b_uni' => 'nullable',
            'm_uni' => 'nullable',

            //exp & lang
            'w_experience_tick' => 'nullable',
            'german_language' => 'nullable',

            //awaireness
            'how_to_know' => 'required',
            'comment' => 'nullable',

            //turms and cond.
            'agree' => 'required',
        ]);

        if(request('program') == 'Direct job'){
            $request->validate([
                'job_feild' => 'required',
            ]);
        }

        if(request('secondary_school') != NULL){
            $request->validate([
                'sec_from' => 'required|numeric',
                'sec_to' => 'required|numeric',
                'sec_result' => 'required|numeric',
            ]);
        }

        if(request('higher_sec_school') != NULL){
            $request->validate([
                'higher_from' => 'required|numeric',
                'higher_to' => 'required|numeric',
                'higher_result' => 'required|numeric',
            ]);
        }

        if(request('v_training_tick')){
            $request->validate([
                'v_field' => 'required',
                'v_complete_year' => 'required|numeric',
                'v_result' => 'required|numeric',
                'v_duration' => 'required|numeric',
            ]);
        }

        if(request('b_uni') != NULL){
            $request->validate([
                'b_major_sub' => 'required',
                'b_year' => 'required|numeric',
                'b_result' => 'required|numeric',
            ]);
        }

        if(request('m_uni') != NULL){
            $request->validate([
                'm_major_sub' => 'required',
                'm_year' => 'required|numeric',
                'm_result' => 'required|numeric',
            ]);
        }

        if(request('w_experience_tick')){
            $request->validate([
                'w_exp_field' => 'required',
                'w_year' => 'required|numeric',
            ]);
        }

        if(request('german_language') == '1'){
            $request->validate([
                'german_level' => 'required',
            ]);
        }

        try{
            DB::transaction(function() {
                $candidate_info = Candidate::create([
                    'first_name' => request('first_name'),
                    'sur_name' => request('sur_name'),
                    'sex' => request('sex'),
                    'dob' => request('dob'),
                    'nationality' => request('nationality'),
                    'telephone' => request('telephone'),
                    'email' => request('email'),
                    'address' => request('address'),
                    'country' => request('country'),
                ]);
        
                Cpf::create([
                    'program' => request('program'),
                    'job_feild' => request('job_feild'),
                    'ge_lang' => request('german_language'),
                    'ge_lang_level' => request('german_level'),
                    'how_to_know' => request('how_to_know'),
                    'agent_id' => request('agent_id'),
                    'comment' => request('comment'),
                    'status_date' => request('status_date'),
                    'comment_institute' => request('comment_institute'),
                    'candidate_id' => $candidate_info->candidate_id,
                ]);
            });
        }catch(Throwable $e){
            // dd($e);
            return back()->with(['error' => 'Application submision failed.', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Application submision successful.']);
        
    }

    public function check_pending_cpf()
    {
        $app_count = Candidate::where('application_status', '2')->count();

        return response()->json($app_count);
    }
}

