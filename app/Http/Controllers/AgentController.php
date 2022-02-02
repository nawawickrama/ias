<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Throwable;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived']);
    }

    public function agent_page()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('agent.create');
        
        if($permission){
             
            $country = Country::all();
            $agent_details = Agent::all();
            $user_agents = Role::where('name', 'Agent')->first()->users;
            return view('admin.agents.agent')->with(['user_agents' => $user_agents, 'agent_details' => $agent_details, 'country' => $country]);
 
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function add_agents(Request $request)
    {   
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('agent.create');

        $agent_details = User::where('email', request('email'));

        if($agent_details == null){
            return back()->with(['error' => 'Email error', 'error_type' => 'error']);
        }
        $agent_id = $agent_details->first()->id;

        if($permission){

            $check = Agent::where('user_id', $agent_id)->count();
            if($check >= 1){
                return back()->with(['error' => 'Agent already registered', 'error_type' => 'error']);
            }

            //genarate reference for agent
            do{
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $reference_no = substr(str_shuffle($chars),0,10);

                //check uniqueness
                $reference_unique = Agent::where('reference_no', $reference_no)->count();
            }while($reference_unique != 0);
            
            $request->validate([
                'name' => 'required',//agent -> name , other role -> user id
                'email' => 'required|unique:users,email,'.$agent_id.',id',
                'tp' => 'required|numeric',
                'tp_2' => 'nullable|numeric',
                'country' => 'required',
                'person_name' => 'required',
                'whatsapp_no' => 'required|numeric',
                'web_site' => 'required',
            ]);

            $agent_name = request('name');//agent -> name , other role -> user id
            $agent_email = request('email');

            $agent_tp = request('tp');
            $agent_tp_2 = request('tp_2');
            $agent_country = request('country');
            $agent_person_name = request('person_name');
            $agent_wa = request('whatsapp_no');
            $agent_web = request('web_site');

            try{
                Agent::create([
                    'agent_tp_1' => $agent_tp,
                    'agent_tp_2' => $agent_tp_2,
                    'agent_country' => $agent_country,
                    'agent_contact_person_name' => $agent_person_name,
                    'agent_whtaspp' => $agent_wa,
                    'agent_web_site' => $agent_web,
                    'agent_status' => 1,
                    'reference_no' => $reference_no,
                    'user_id' => $agent_id
                ]);

            }catch(Throwable $e){
                // dd($e);
                return back()->with(['error' => 'Agent registration failed', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Agent registerd']);
           
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function edit_agents(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('agent.edit');
        
        if($permission){

            $request->validate([
                'agent_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'tp' => 'required|numeric',
                'country' => 'required',
                'person_name' => 'required',
                'whatsapp_no' => 'required|numeric',
                'web_site' => 'required',
            ]);

            $agent_name = request('name');
            $agent_email = request('email');
            $agent_tp = request('tp');
            $agent_country = request('country');
            $agent_person_name = request('person_name');
            $agent_wa = request('whatsapp_no');
            $agent_web = request('web_site');

            try{
                Agent::find(request('agent_id'))->update([
                    // 'agent_name' => $agent_name,
                    // 'agent_email' => $agent_email,
                    'agent_tp_1' => $agent_tp,
                    'agent_country' => $agent_country,
                    'agent_contact_person_name' => $agent_person_name,
                    'agent_whtaspp' => $agent_wa,
                    'agent_web_site' => $agent_web,
                    'agent_status' => 1
                ]);

            }catch(Throwable $e){
                // dd($e);
                return back()->with(['error' => 'Agent update failed', 'error_type' => 'error']);
            }
             
            return back()->with(['success' => 'Agent updated']);
           
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function act_dea_agents(Request $request)
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('aget.edit');

        if($permission){

            $agent_id = request('agent_id');
            $status = request('status');

            try{
                Agent::find($agent_id)->update([
                    'agent_status' => $status,
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'Agent active/deactive failed', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Updated']);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function country_agent(Request $request)
    {
        $country = request('country');
        $agent_details = Agent::where('agent_country', $country)->get();

        foreach($agent_details as $agent){
            echo "<option value='$agent->agent_id'>$agent->agent_name</option>";
        }
    }

    public function name_email(Request $request)
    {
        $user_id = request('user_id');
        $agent_info = User::find($user_id);

        return response()->json($agent_info);
    }
}
