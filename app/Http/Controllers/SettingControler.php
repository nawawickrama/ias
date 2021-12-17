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
        $this->middleware(['auth', 'actived']);
    }

    public function smtp_page()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('view smtp setting');

        if($permission){
            $smtp_setting = Smtp::orderbyDesc('id')->first();
            return view('admin.settings.smtp')->with(['smtp_setting' => $smtp_setting]);
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
                $d = Smtp::create([
                'MAIL_HOST' => request('host'),
                'MAIL_PORT' => request('port'),
                'MAIL_USERNAME' => request('uname'),
                'MAIL_PASSWORD' => request('pword'),
                ]);
                
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
