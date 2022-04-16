<?php

namespace App\Http\Controllers;


use App\Notifications\cpfRequestNotify;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\Course;
use App\Models\Cpf;
use App\Models\HigherEdu;
use App\Models\Lead;
use App\Models\SecondaryEdu;
use App\Models\VocationalTraining;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CpfController extends Controller
{
    public function cpf()
    {
        $country = Country::all();
        $course_details = Course::where('course_status', '1')->get();
        return view('cpf.cpf')->with(['country' => $country, 'course_details' => $course_details]);
    }


    public function cpf_post(Request $request)
    {
        $request->validate([
            //cpf
            'course_id' => 'required',

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
            'german_language' => 'required',

            //awaireness
            'how_to_know' => 'required',
            'comment' => 'nullable',

            //turms and cond.
            'agree' => 'required',
        ]);

        $course_code = Course::find(request('course_id'))->course_code;

        if ( $course_code == 'Direct job') {
            $request->validate([
                'job_feild' => 'required',
            ]);
        }

        if (request('secondary_school') != NULL) {
            $request->validate([
                'sec_from' => 'required|numeric',
                'sec_to' => 'required|numeric',
                'sec_result' => 'required|numeric',
            ]);
        }

        if (request('higher_sec_school') != NULL) {
            $request->validate([
                'higher_from' => 'required|numeric',
                'higher_to' => 'required|numeric',
                'higher_result' => 'required|numeric',
            ]);
        }

        if (request('v_training_tick')) {
            $request->validate([
                'v_field' => 'required',
                'v_complete_year' => 'required|numeric',
                'v_result' => 'required|numeric',
                'v_duration' => 'required|numeric',
            ]);
        }

        if (request('bachelors_tick')) {
            $request->validate([
                'b_uni' => 'required',
                'b_major_sub' => 'required',
                'b_year' => 'required|numeric',
                'b_result' => 'required|numeric',
            ]);
        }

        if (request('masters_tick')) {
            $request->validate([
                'm_uni' => 'required',
                'm_major_sub' => 'required',
                'm_year' => 'required|numeric',
                'm_result' => 'required|numeric',
            ]);
        }

        if (request('w_experience_tick')) {
            $request->validate([
                'w_exp_field' => 'required',
                'w_year' => 'required|numeric',
            ]);
        }

        if (request('german_language') == '1') {
            $request->validate([
                'german_level' => 'required',
            ]);
        }

        //check candidate
        $candidate_details = Candidate::where('email', request('email'));
        $cpf_info = '';
        try {
            DB::transaction(function () use ($candidate_details, &$cpf_info) {

                if ($candidate_details->count() > 0) {
                    $candidate_info = $candidate_details->first();
                } else {
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
                }

                $cpf_info = Cpf::create([
                    'course_id' => request('course_id'),
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


                if (request('secondary_school') != NULL) {
                    SecondaryEdu::create([
                        'years_level' => request('secondary_school'),
                        'duration' => request('sec_from') - request('sec_to'),
                        'result_percentage' => request('sec_result'),
                        'sec_edu_type' => 'Secondary School',
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }

                if (request('higher_sec_school') != NULL) {
                    SecondaryEdu::create([
                        'years_level' => request('higher_sec_school'),
                        'duration' => request('higher_from') - request('higher_to'),
                        'result_percentage' => request('higher_result'),
                        'sec_edu_type' => 'Higher School',
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }

                if (request('v_training_tick')) {
                    VocationalTraining::create([
                        'field' => request('v_field'),
                        'complete_year' => request('v_complete_year'),
                        'result_percentage' => request('v_result'),
                        'duration' => request('v_duration'),
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }

                if (request('w_experience_tick')) {
                    WorkExperience::create([
                        'field' => request('w_exp_field'),
                        'duration' => request('w_year'),
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }

                if (request('b_uni') != NULL) {
                    HigherEdu::create([
                        'university' => request('b_uni'),
                        'major_subject' => request('b_major_sub'),
                        'year' => request('b_year'),
                        'result_percentage' => request('b_result'),
                        'higher_edu_type' => 'Bachelors',
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }

                if (request('m_uni') != NULL) {
                    HigherEdu::create([
                        'university' => request('m_uni'),
                        'major_subject' => request('m_major_sub'),
                        'year' => request('m_year'),
                        'result_percentage' => request('m_result'),
                        'higher_edu_type' => 'Masters',
                        'cpf_id' => $cpf_info->cpf_id,
                    ]);
                }
            });
        } catch (Throwable $e) {
            //dd($e);
            return back()->with(['error' => 'Application submision failed.', 'error_type' => 'error']);
        }

        //notification

        if(!empty(\request('agent_id'))){

            $user_id = Agent::find(\request('agent_id'))->user_id;
            $user = \App\Models\User::role('Agent')->where('id', $user_id)->get();
            \Illuminate\Support\Facades\Notification::sendnow($user, new cpfRequestNotify($cpf_info));
        }

        //super admin notification
        $user = \App\Models\User::role('Super Admin')->get();
        \Illuminate\Support\Facades\Notification::sendnow($user, new cpfRequestNotify($cpf_info));

        return back()->with(['success' => 'Application submission successful.']);
    }

    public function check_pending_cpf()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('pending-request.view');

        if ($permission) {
            $app_count = Cpf::where('application_status', '2');

            if ($user->hasRole('Agent')) {
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;
                $app_count = $app_count->where('agent_id', $agent_id);
            }

            $app_count = $app_count->count();
            return response()->json($app_count);
        }
    }

    public function agent_cpf($reference_no)
    {
        $agent_details = Agent::where([['agent_status', 1], ['reference_no', $reference_no]])->first();

        if($agent_details == NULL){
            return redirect('/login')->with(['error' => 'Invalid Reference / Inactive Agent', 'error_type' => 'warning']);
        }

        $country = Country::all();
        $course_details = Course::where('course_status', '1')->get();

        return view('cpf.cpf')->with(['course_details' => $course_details, 'reference_no' => $reference_no, 'country' => $country, 'agent_details' => $agent_details]);
    }

    public function lead_cpf_form($lead_random_num)
    {
        $lead_details = Lead::where('lead_random_number', $lead_random_num)->first();
        $country = Country::all();
        $course_details = Course::where('course_status', '1')->get();

        return view('cpf.cpf')->with(['lead_details' => $lead_details, 'country' => $country, 'course_details' => $course_details]);
    }
}
