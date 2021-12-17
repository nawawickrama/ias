<?php

namespace App\Http\Controllers;

use App\Mail\AddUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived']);
    }

    public function user()
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('view user');

        if($permission){
            $user_details = User::all();

            return view('admin.settings.user')->with(['user_details' => $user_details]);
        }else{
            Auth::logout();
            abort(403);
        }

    }

    public function add_user(Request $request)
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('add user');
        
        if($permission){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $pwrd = substr(str_shuffle($chars),0,8);

            try{
                $user_data = User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => Hash::make(request($pwrd)),
                    'status' => 1,
                ]);

                $user_data->assignRole('Super Admin');
            }catch(Throwable $e){
                return back()->with(['error' => 'User Registration failed', 'error_type' => 'error']);
            }
            
            Mail::to($user_data->email)->send(new AddUser($pwrd));
            return back()->with(['success' => 'User Registration Successful']);

        }else{
            Auth::logout();
            abort(403);
        }


    }
}
