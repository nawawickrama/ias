<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function mark_as_read_notification($notification){

        if($notification == 'all'){
            auth()->user()->unreadNotifications->markAsRead();
        }else{

            $notificationInfo = auth()->user()->notifications()->find($notification);
            $notificationInfo->markAsRead();

            $notify = $notificationInfo->data['info'];

            if($notify == 'Pending Lead.'){
                return redirect()->route('pending_lead');
            }

            if($notify == 'Pending CPF Request.'){
                return redirect()->route('pending-requests');
            }
        }



        return redirect()->back();
    }
}
