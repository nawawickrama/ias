<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\HigherEdu;
use App\Models\SecondaryEdu;
use App\Models\VocationalTraining;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CandidareController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function application()
    {
        $country = Country::all();
        $agent_details = Agent::where('agent_status', 1)->get();
        return view('landing.home')->with(['agent_details' => $agent_details, 'country' => $country]);
    }

    public function reg_candi(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'first_name' => 'required',
            'sur_name' => 'required',
            'sex' => 'required',
            'dob' => 'required|date',
            'nationality' => 'required',
            'telephone' => 'required',
            'telephone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zip' => 'required',
            'country' => 'required',

            'secondary_school' => 'nullable',
            
            'higher_sec_school' => 'nullable',

            'v_training_tick' => 'nullable',

            'b_uni' => 'nullable',

            'm_uni' => 'nullable',

            'w_experience_tick' => 'nullable',

            'german_language' => 'nullable',

            'agree' => 'required',

            'comment' => 'nullable',

            'how_to_know' => 'required'
        ]);
        if(request('project') == 'Direct job'){
            $request->validate([
                'job_feild' => 'required',
            ]);
        }

        if(request('secondary_school') !=  null){
            $request->validate([
                'sec_from' => 'required',
                'sec_to' => 'required',
                'sec_result' => 'required|numeric',
            ]);
        }

        if(request('higher_sec_school') !=  null){
            $request->validate([
                'highter_from' => 'required',
                'highter_to' => 'required',
                'highter_result' => 'required|numeric',
            ]);
        }

        if(request('v_training_tick') ==  1){
            $request->validate([
                'v_field' => 'required',
                'v_complete_year' => 'required',
                'v_result' => 'required|numeric',
                'v_duration' => 'required',
            ]);
        }

        if(request('b_uni') !=  null){
            $request->validate([
                'b_major_sub' => 'required',
                'b_year' => 'required',
                'b_result' => 'required|numeric',
            ]);
        }

        if(request('m_uni') !=  null){
            $request->validate([
                'm_major_sub' => 'required',
                'm_year' => 'required',
                'm_result' => 'required|numeric',
            ]);
        }
        
        if(request('w_experience_tick') ==  1){
            $request->validate([
                'w_exp_field' => 'required',
                'w_year' => 'required',
            ]);
        }

        if(request('german_language') ==  1){
            $request->validate([
                'german_level' => 'required',
            ]);
        }

        if(request('how_to_know') ==  'Agent/Educational Consultancy'){
            $request->validate([
                'agent_id' => 'required',
            ]);
        }
        
        try{
            DB::transaction(function () {
                $candidate_info = Candidate::create([
                    'first_name' => request('first_name'),
                    'sur_name' => request('sur_name'),
                    'sex' => request('sex'),
                    'program' => request('project'),
                    'job_feild' => request('job_feild'),
                    'dob' => request('dob'),
                    'nationality' => request('nationality'),
                    'telephone' => request('telephone'),
                    'email' => request('email'),
                    'address' => request('address').','.request('city').','.request('province').','.request('country').','.request('zip'),
                    'country' => request('country'),
                    'ge_lang' => request('german_language'),
                    'ge_lang_level' => request('german_level'),
                    'how_to_know' => request('how_to_know'),
                    'agent_id' => request('agent_id'),
                    'comment' => request('comment'),
                ]);

                if(request('secondary_school') !=  null){
                    SecondaryEdu::create([
                        'years_level' => request('secondary_school'),
                        'duration' => request('sec_from').' - '.request('sec_to'),
                        'result_percentage' => request('sec_result'),
                        'sec_edu_type' => 'Secondary',
                        'candidate_id' => $candidate_info->candidate_id,
                    ]);
                }

                if(request('higher_sec_school') !=  null){
                    SecondaryEdu::create([
                        'years_level' => request('higher_sec_school'),
                        'duration' => request('highter_from').' - '.request('highter_to'),
                        'result_percentage' => request('highter_result'),
                        'sec_edu_type' => 'Higher',
                        'candidate_id' => $candidate_info->candidate_id,
                    ]);
                }

                if(request('b_uni') !=  null){
                    HigherEdu::create([
                        'university' => request('b_uni'),
                        'major_subject' => request('b_major_sub'),
                        'year' => request('b_year'),
                        'result_percentage' => request('b_result'),
                        'higher_edu_type' => 'Batchelor',
                        'candidate_id' => $candidate_info->candidate_id
                    ]);
                }

                if(request('m_uni') !=  null){
                    HigherEdu::create([
                        'university' => request('m_uni'),
                        'major_subject' => request('m_major_sub'),
                        'year' => request('m_year'),
                        'result_percentage' => request('m_result'),
                        'higher_edu_type' => 'Masters',
                        'candidate_id' => $candidate_info->candidate_id
                    ]);
                }

                if(request('v_training_tick') ==  1){
                    VocationalTraining::create([
                        'field' => request('v_field'),
                        'compleate_year' => request('v_complete_year'),
                        'result_percentage' => request('v_result'),
                        'duration' => request('v_duration'),
                        'candidate_id' => $candidate_info->candidate_id
                    ]);
                }

                if(request('w_experience_tick') ==  1){
                    WorkExperience::create([
                        'field' => request('w_exp_field'),
                        'duration' => request('w_year'),
                        'candidate_id' => $candidate_info->candidate_id,
                    ]);
                }
            });
        }catch(Throwable $e){
            // dd($e);
            return back()->with(['error' => 'Form submition faild.' , 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Form submition succesful.']);
    }

    public function check_pending_application()
    {
        $app_count = Candidate::where('application_status', '2')->count();

        return response()->json($app_count);
    }
}
