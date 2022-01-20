<?php

namespace App\Http\Controllers;

use App\Models\Smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        $permission = $user->can('smtp-setting.edit');

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
         $permission = $user->can('smtp-setting.create');

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

    public function role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role-management-view');

        if($permission){

            $role_details = Role::all();
            $permission_details = Permission::all();
            return view('admin.settings.new-role')->with(['role_details' => $role_details, 'permission_details' => $permission_details]);
        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function role_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role-management.create');

        if($permission){
            
            $request->validate([
                'role' => 'required',
                'role_color' => 'nullable',
            ]);

            try{
                Role::create(['name' => request('role'), 'color' => request('role_color')]);

            }catch(Throwable $e){
                return back()->with(['error' => 'Role create Failed.', 'error_type' => 'error']);
            }
            
            return back()->with(['success' => 'Role create successful.']);

        }else{
            Auth::logout();
            abort(403);
        }
    }

    public function permission_role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission-management.view');
 
        if($permission){
            $permission_details = Permission::all();
            $role_details = Role::all();

            return view('admin.settings.role-permission')->with(['permission_details' => $permission_details, 'role_details' => $role_details]);
        }else{
            Auth::logout();
            abort(403);
        }
    }

    
}
