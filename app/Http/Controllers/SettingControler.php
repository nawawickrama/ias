<?php

namespace App\Http\Controllers;

use App\Models\Smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SettingControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function smtp_page()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view smtp setting');

        if($permission){
            $smtp_host = env('MAIL_HOST');
            $smtp_port = env('MAIL_PORT');
            $smtp_uname = env('MAIL_USERNAME');
            $smtp_pwrd = env('MAIL_PASSWORD');

            return view('admin.settings.smtp')->with(['smtp_host' => $smtp_host, 'smtp_port' => $smtp_port, 'smtp_uname' => $smtp_uname, 'smtp_pwrd' => $smtp_pwrd]);
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function set_smtp(Request $request)
    {
         /** @var App\Models\User $user */
         $user = Auth::user();
         $permission = $user->can('set smtp setting');

        if($permission){
            $host = request('host');
            $port = request('port');
            $uname = request('uname');
            $pword = request('pword');

            try{
                $d = Smtp::firstOrCreate();
                $d->MAIL_HOST = request('host');
                $d->MAIL_PORT = request('port');
                $d->MAIL_USERNAME = request('uname');
                $d->MAIL_PASSWORD = request('pword');
                $d->save();
                
            }catch(Throwable $e){
                dd($e);
                return back()->with(['error' => 'SMTP setting failed.']);
            }

            return back()->with(['success' => 'SMTP setting added.']);

        }else{
            Auth::logout();
            abort(403);
        }

    }
}
