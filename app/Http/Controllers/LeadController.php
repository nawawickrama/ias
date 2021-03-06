<?php

namespace App\Http\Controllers;

use App\activityLog;
use App\Models\ActivityLog as ModelsActivityLog;
use App\Models\Agent;
use App\Models\Country;
use App\Models\Course;
use App\Models\DelayNotification;
use App\Models\Lead;
use App\Models\User;
use App\Notifications\PendingLeadNotify;
use App\Notifications\SetReminderNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Throwable;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function create()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $sur_name = request('sur_name');
        $first_name = request('first_name');
        $whatsapp_no = request('whatsapp_no');
        $contact_no = request('contact_no');
        $course_id = request('course_id');
        $intake_year = request('intake_year');
        $country_id = request('country_id');
        $city_id = request('city_id');
        $email = request('email');
        $source = request('source');
        $comment = request('comment');

        try {
            $leadInfo = Lead::create([
                'lead_first_name' => $first_name,
                'lead_sur_name' => $sur_name,
                'lead_email' => $email,
                'lead_course_id' => $course_id,
                'lead_intake_year' => $intake_year,
                'lead_city' => $city_id,
                'lead_country_id' => $country_id,
                'lead_source' => $source,
                'lead_comment' => $comment,
                'lead_contact' => $contact_no,
                'lead_whatsapp' => $whatsapp_no,
            ]);

            $activity = Auth::user()->name . ' create new lead.';
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'create-lead', $leadInfo->lead_id);
            $assignMyLead->addLog();
        } catch (Throwable $e) {
            // dd($e);
            return back()->with(['error' => 'Lead insert fail', 'error_type' => 'error']);
        }

        $users = User::role('Super Admin')->get();
        Notification::sendNow($users, new PendingLeadNotify($leadInfo));

        return back()->with(['success' => 'Lead inserted.']);
    }

    public function edit_lead()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead.edit');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $sur_name = request('sur_name');
        $first_name = request('first_name');
        $whatsapp_no = request('whatsapp_no');
        $contact_no = request('contact_no');
        $course_id = request('course_id');
        $intake_year = request('intake_year');
        $country_id = request('country_id');
        $city_id = request('city_id');
        $email = request('email');
        $source = request('source');
        $comment = request('comment');

        try {
            Lead::find(request('lead_id'))->update([
                'lead_first_name' => $first_name,
                'lead_sur_name' => $sur_name,
                'lead_email' => $email,
                'lead_course_id' => $course_id,
                'lead_intake_year' => $intake_year,
                'lead_city' => $city_id,
                'lead_country_id' => $country_id,
                'lead_source' => $source,
                'lead_comment' => $comment,
                'lead_contact' => $contact_no,
                'lead_whatsapp' => $whatsapp_no,
            ]);

            $activity = Auth::user()->name . ' edit lead.';
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'create-lead', request('lead_id'));
            $assignMyLead->addLog();
        } catch (Throwable $e) {
            // dd($e);
            return back()->with(['error' => 'Lead insert fail', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Lead inserted.']);
    }

    public function lead_pending()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::where('status', '2');

        $couses = Course::where('course_status', '1')->get();
        $countries = Country::all();
        $agent_details = Agent::where('agent_status', 1)->get();


        if ($user->hasRole('Agent')) {
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = $lead_details->where('agent_id', $my_agent_id);
        }

        $lead_details = $lead_details->get();
        return view('admin.leads.pending-leads')->with(['countries' => $countries, 'couses' => $couses, 'lead_details' => $lead_details, 'agent_details' => $agent_details]);
    }

    public function assgn_leads_to_agent()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.assign');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');
        $agent_user_id = request('agent_id');

        try {
            Lead::find($lead_id)->update([
                'status' => '3',
                'handle_by' => $agent_user_id,
                'assign_by' => $user->id,
                'assign_at' => date('Y-m-d H:i:s'),
            ]);

            $agent_info = User::find($agent_user_id)->name;
            $activity = Auth::user()->name . ' assign lead to ' . $agent_info;
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'assign-to-agent', $lead_id);
            $assignMyLead->addLog();

        } catch (Throwable $e) {
            return back()->with(['error' => 'Lead assigned fail', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Lead assigned']);
    }

    public function assign_my_self()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.assign-my-self');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');

        try {
            Lead::find($lead_id)->update([
                'status' => '3',
                'handle_by' => $user->id,
                'assign_by' => $user->id,
                'assign_at' => date('Y-m-d H:i:s'),
            ]);

            $activity = Auth::user()->name . ' assign self lead.';
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'assign-my-self', $lead_id);
            $assignMyLead->addLog();
        } catch (Throwable $e) {
            // dd($e);
            return back()->with(['error' => 'Lead assigned fail', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Lead assigned yor self']);
    }

    public function leade_delete()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.assign');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');
        $reason = request('delete_reason');

        try {
            $lead_details = Lead::find($lead_id)->update([
                'status' => '4',
                'delete_reason' => $reason,
                'deleted_by' => $user->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);

            $activity = Auth::user()->name . ' delete lead.';
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'delete-lead', $lead_id);
            $assignMyLead->addLog();
        } catch (Throwable $e) {
            return back()->with(['error' => 'Lead assigned fail', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Lead assigned']);
    }

    public function my_leads()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-my-lead.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::whereIn('status', ['1', '3'])->where('handle_by', $user->id)->get();

        $couses = Course::where('course_status', '1')->get();
        $countries = Country::all();

        return view('admin.leads.my-leads')->with(['countries' => $countries, 'couses' => $couses, 'lead_details' => $lead_details]);
    }

    public function all_leads()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-pending.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        if ($user->hasRole('Agent')) {
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = Lead::where('agent_id', $my_agent_id)->get();
        } else {
            $lead_details = Lead::all();
        }
        $couses = Course::where('course_status', '1')->get();
        $countries = Country::all();

        return view('admin.leads.all-leads')->with(['countries' => $countries, 'couses' => $couses, 'lead_details' => $lead_details]);
    }

    public function lead_convert_to_potential()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-potential.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');

        //genarate reference for agent
        do {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $random_no = substr(str_shuffle($chars), 0, 10);

            //check uniqueness
            $lead_random_number = Lead::where('lead_random_number', $random_no)->count();
        } while ($lead_random_number != 0);

        try {
            Lead::find($lead_id)->update([
                'status' => '1',
                'lead_random_number' => $random_no,
            ]);

            $activity = Auth::user()->name . ' make as potential lead.';
            $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'make-potential-lead', $lead_id);
            $assignMyLead->addLog();
        } catch (Throwable $e) {
            return back()->with(['error' => 'Oparation faild.', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Lead make as potential']);
    }

    public function potential_lead()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-potential.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_details = Lead::where('status', '1');

        if ($user->hasRole('Agent')) {
            $my_agent_id = User::find($user->id)->agent->agent_id;
            $lead_details = $lead_details->where('agent_id', $my_agent_id);
        }

        $lead_details = $lead_details->get();

        $couses = Course::where('course_status', '1')->get();
        $countries = Country::all();
        return view('admin.leads.potential-leads')->with(['countries' => $countries, 'couses' => $couses, 'lead_details' => $lead_details]);
    }

    public function setReminder()
    {
        $leadId = \request('lead_id');
        $dateTime = \request('reminderTime');
        $note = \request('note');

        DelayNotification::create([
            'cron_time' => $dateTime,
            'user_id' => Auth::user()->id,
            'lead_id' => $leadId,
            'note' => $note,
        ]);

        $activity = Auth::user()->name . ' set reminder to ' . $dateTime;
        $assignMyLead = new activityLog($activity, 'App\Models\Laed', 'set-reminder', $leadId);
        $assignMyLead->addLog();

        return back()->with(['success' => 'Lead Reminder Added']);
    }

    public function viewLeadActivity(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-activitylog.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $lead_id = request('lead_id');
        $activity_log = ModelsActivityLog::where([['model', 'App\Models\Laed'], ['property_id', $lead_id]])->get();

        foreach($activity_log as $activity){
            echo $activity->event.' - '.$activity->info.' ---> '.$activity->created_at.'<br>';
        }
    }
}
