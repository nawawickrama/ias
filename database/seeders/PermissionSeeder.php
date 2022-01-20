<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_info = [
            'permission-management',
            'user-management',
            'pending-candidates',
            'selected-candidates',
            'selected-candidates-under-condition',
            'rejected-candidates',
            'application',
            'application-download',
            'assesment-form-send',
            'assesment-form-email',
            'assesment-form-download',
            'application-reverse',
            'email-send',
            'smtp-setting',
        ];

        foreach($permission_info as $permission){
            Permission::create(['name' => $permission]);
        }
        
    }
}
