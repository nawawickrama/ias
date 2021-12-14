<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function add_user()
    {
        /** @var App\Model\User $user */
        $user = Auth::user();
        $permission = $user->can('add user');

        if($permission){

            try{
                User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => Hash::make(request('password')),
                    'status' => 1,
                ]);
            }catch(Throwable $e){
                return back()->with(['error' => 'User Registration failed', 'error_type' => 'error']);
            }
            
            return back()->with(['success' => 'User Registration Successful']);

        }else{
            Auth::logout();
            abort(403);
        }


    }
}
