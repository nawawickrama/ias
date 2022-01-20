<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();

        // $array = [
        //     ['permission' => ['group' => 'permission-management','name' => ['permission-management-add','permission-management-view']]],
        //     ['permission' => ['group' => 'user-management','name' => ['user-management-add','user-management-view']]],
        // ];

        // $per_groups = Arr::pluck($array, 'permission.group');
        // foreach($per_groups as $group){
        //     return $names = Arr::pluck($array, 'permission.name', 'permission.group');

        // }

        
        // return $names = Arr::pluck($array, 'permission.name', 'permission.group');
        // $aa = [];
        // $c = 0;
        // foreach($names as $name){
        //     foreach($name as $kk){
        //     // return $kk;
        //     $aa[$c] = $kk;
        //     $c++;
        //     }
        // }

        // return $aa;

       

        // Role::create(['name' => 'Super Admin']);
        // $user->assignRole('Super Admin');
        return view('admin.home');
    }
}
