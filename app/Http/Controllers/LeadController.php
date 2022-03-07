<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LeadController extends Controller
{
    public function __construct()
    {
         $this->middleware(['auth', 'actived', 'agent']);
    }

    public function lead_pending()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.view');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::where('status', '2');
        $agent_details = Agent::where('agent_status', 1)->get();

        if($user->hasRole('Agent')){
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = $lead_details->where('agent_id', $my_agent_id);
        }

        $lead_details = $lead_details->get();
        return view('admin.leads.pending-leads')->with(['lead_details' => $lead_details, 'agent_details' => $agent_details]);

    }

    public function assgn_leads_to_agent()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.assign');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');
        $agent_id = request('agent_id');

        try{
            $lead_details  = Lead::find($lead_id)->update([
                'status' => '3',
                'agent_id' => $agent_id,
                'assign_by' => $user->id,
                'assign_at' => date('Y-m-d H:i:s'),
            ]);
        }catch(Throwable $e){
            return back()->with(['error' => 'Lead assigned fail', 'error_type' => 'error']);
        }
       
        return back()->with(['success' => 'Lead assigned']);

    }

    public function leade_delete()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.assign');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');
        $reason = request('delete_reason');

        try{
            $lead_details  = Lead::find($lead_id)->update([
                'status' => '4',
                'delete_reason' => $reason,
                'deleted_by' => $user->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
        }catch(Throwable $e){
            return back()->with(['error' => 'Lead assigned fail', 'error_type' => 'error']);
        }
       
        return back()->with(['success' => 'Lead assigned']);

    }

    public function my_leads()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-my-lead.view');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::whereIn('status', ['1', '3']);

        if($user->hasRole('Agent')){
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = $lead_details->where('agent_id', $my_agent_id);
        }

        $lead_details = $lead_details->get();
        return view('admin.leads.my-leads')->with(['lead_details' => $lead_details]);

    }

    public function all_leads()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.view');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        if($user->hasRole('Agent')){
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = Lead::where('agent_id', $my_agent_id)->get();
        }else{
            $lead_details = Lead::all();
        }

        return view('admin.leads.all-leads')->with(['lead_details' => $lead_details]);

    }

    public function lead_convert_to_potential()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-potential.create');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');

        //genarate reference for agent
        do{
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $random_no = substr(str_shuffle($chars),0,10);

            //check uniqueness
            $lead_random_number = Lead::where('lead_random_number', $random_no)->count();
        }while($lead_random_number != 0);

        try{
            Lead::find($lead_id)->update([
                'status' => '1',
                'lead_random_number' => $random_no,
            ]);
        }catch(Throwable $e){
            return back()->with(['error' => 'Oparation faild.', 'error_type' => 'error']);
        }
        
        return back()->with(['success' => 'Lead make as potential']);
    }

    public function potential_lead()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-potential.view');
        
        if(!$permission){
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::where('status', '1');

        if($user->hasRole('Agent')){
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = $lead_details->where('agent_id', $my_agent_id);
        }

        $lead_details = $lead_details->get();
        return view('admin.leads.potential-leads')->with(['lead_details' => $lead_details]);

    }
}
