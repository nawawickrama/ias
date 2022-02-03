<?php

namespace App\Http\Controllers;

use App\Models\PermissionList;
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
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function smtp_page()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('smtp-setting.edit');

        if ($permission) {
            $smtp_setting = Smtp::orderbyDesc('id')->first();
            return view('admin.settings.smtp')->with(['smtp_setting' => $smtp_setting]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function set_smtp(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('smtp-setting.create');

        if ($permission) {
            $host = request('host');
            $port = request('port');
            $uname = request('uname');
            $pword = request('pword');

            try {
                $d = Smtp::create([
                    'MAIL_HOST' => request('host'),
                    'MAIL_PORT' => request('port'),
                    'MAIL_USERNAME' => request('uname'),
                    'MAIL_PASSWORD' => request('pword'),
                ]);
            } catch (Throwable $e) {
                dd($e);
                return back()->with(['error' => 'SMTP setting failed.']);
            }

            return back()->with(['success' => 'SMTP setting added.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role.view') || $user->can('role.create');

        if ($permission) {

            $role_details = Role::all();
            $permission_details = Permission::all();
            return view('admin.settings.new-role')->with(['role_details' => $role_details, 'permission_details' => $permission_details]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function role_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role.create');

        if ($permission) {

            $request->validate([
                'role' => 'required',
                'role_color' => 'nullable',
            ]);

            try {
                Role::create(['name' => request('role'), 'color' => request('role_color')]);
            } catch (Throwable $e) {
                return back()->with(['error' => 'Role create Failed.', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Role create successful.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function permission_role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.view') || $user->can('permission.create');

        if ($permission) {
            $permission_details = PermissionList::all();
            $role_details = Role::where('name', '!=', 'Super Admin')->get();

            return view('admin.settings.role-permission')->with(['permission_details' => $permission_details, 'role_details' => $role_details]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function permission_role_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.create') || $user->can('permission.edit');

        if ($permission) {
            $all_permission = PermissionList::all();
            $role_id = request('role_id');
            $role = Role::find($role_id);

            if ($user->can('permission.edit')) {
                $role->syncPermissions();
            }

            try {
                foreach ($all_permission as $per) {
                    $input = request($per->name);
                    if ($input != null) {
                        foreach ($input as $in) {
                            $permission = $per->name . '.' . $in;
                            $role->givePermissionTo($permission);
                        }
                    }
                }
            } catch (Throwable $e) {
                return back()->with(['error' => 'Permission added faild.', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Permission added successful.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function fill_permission(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $role_id = request('role_id');
        $permission = Role::find($role_id)->permissions;

        return response()->json($permission);
    }
}
