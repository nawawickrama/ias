<?php

namespace App\Http\Controllers;

use App\Mail\AddUser;
use App\Mail\newUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Throwable;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function user()
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('view-management.user');

        if($permission){
            $user_details = User::all();
            $role_details = Role::all();
            return view('admin.settings.user')->with(['user_details' => $user_details, 'role_details' => $role_details]);
        }else{
            Auth::logout();
            abort(403);
        }

    }

    public function add_user(Request $request)
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('user-management.create');
        
        if($permission){
            // return 1;
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
            ]);

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $pwrd = substr(str_shuffle($chars),0,8);
            $role = Role::find(request('role'));
            $user_data = null;

            try{
                DB::transaction(function () use($pwrd, $role, &$user_data){
                    $user_data = User::create([
                        'name' => request('name'),
                        'email' => request('email'),
                        'password' => Hash::make($pwrd),
                        'status' => 1,
                    ]);

                    $user_data->assignRole($role->name);
                });
                
            }catch(Throwable $e){
                return back()->with(['error' => 'User Registration failed', 'error_type' => 'error']);
            }

            if($user_data != null){
                Mail::to($user_data->email)->send(new NewUser($pwrd));
            }

            Session::put(['success' => 'User Registration Successful']);
            return back();

        }else{
            Auth::logout();
            abort(403);
        }


    }

    public function active_inactive(Request $request)
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('user-management.edit');

        if($permission){

            $user_id = request('user_id');
            $status = request('status');

            try{
                User::find($user_id)->update([
                    'status' => $status,
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'User active/deactive failed', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Updated']);

        }else{
            Auth::logout();
            abort(403);
        }
    }
}
