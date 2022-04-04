<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function mark_as_read_notification($notification){
        $notification = Notification::find($notification);
        $notification->update(['read_at' => now()]);

        $notify = json_decode($notification->data);


        if($notify->info == 'New Pending Lead.'){
            return redirect()->route('pending_lead');
        }

        return redirect()->back();
    }
}