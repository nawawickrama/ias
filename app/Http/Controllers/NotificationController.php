<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\CandidateDocument;
use App\Models\Cpf;
use App\Models\Document;
use App\Models\Lead;
use App\Models\Notification;
use App\Models\Potential;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function mark_as_read_notification($notification)
    {

        if ($notification == 'all') {
            auth()->user()->unreadNotifications->markAsRead();
        } else {

            $notificationInfo = auth()->user()->notifications()->find($notification);
            $notificationInfo->markAsRead();

            $notify = $notificationInfo->data['info'];

            if ($notify == 'Pending Lead.') {
                return redirect()->route('pending_lead');
            }

            if ($notify == 'Pending CPF Request.') {
                return redirect()->route('pending-requests');
            }
        }

        return redirect()->back();
    }

    public function notifications()
    {
        if (Auth::check()) {
            $notifications = Auth::user()->unreadNotifications->take(5);
            foreach ($notifications as $notification) {
                echo "<a href=\"{{route('mark_as_read_notification',$notification)}}\" class=\"dropdown-item\">
                    <div class=\"icon\">
                        <i data-feather=\"layers\"></i>
                    </div>
                    <div class=\"content\">
                        <p>{$notification->data['info']}</p>
                        <p class=\"sub-text text-muted\">{$notification->data['time']}</p>
                    </div>
                </a>";
            }

        }
    }

    public function notificationCount()
    {
        if (Auth::check()) {
            $notifications = Auth::user()->unreadNotifications->count();
        }else{
            $notifications = 0;
        }

        return response()->json(['count' => $notifications]);
    }

    public function indicator()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('pending-request.view');

        if ($permission) {
            //pending-cpf
            $pendingCPF = Cpf::where('application_status', '2');
            $pendingLeads = Lead::where('status', 2);
            $potentialStudent =Potential::where('potential_status', 1);
            $pendingDocument = CandidateDocument::where('status', 'Pending');

            if ($user->hasRole('Agent')) {
                $agent_id = Agent::where('user_id', $user->id)->first()->agent_id;

                $pendingCPF = $pendingCPF->where('agent_id', $agent_id);
                $pendingLeads = $pendingLeads->where('handle_by', $user->id);
                $potentialStudent = $potentialStudent->where('agent_id', $agent_id);
            }

            $pendingCPF = $pendingCPF->count();
            $pendingLeads = $pendingLeads->count();
            $potentialStudent = $potentialStudent->count();
            $pendingDocument = $pendingDocument->count();

            $response ['pendingCPF'] =  $pendingCPF;
            $response ['pendingLeads'] =  $pendingLeads;
            $response ['potentialStudent'] =  $potentialStudent;
            $response ['pendingDocument'] =  $pendingDocument;

            return response()->json($response);
        }
    }
}
