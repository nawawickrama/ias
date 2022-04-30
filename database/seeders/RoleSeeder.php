<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_details =[
            'Super Admin',
            'Agent',
            'Default User',
            'Student',
        ];

        foreach($role_details as $role){
            Role::create(['name' => $role]);
        }

    }
}
