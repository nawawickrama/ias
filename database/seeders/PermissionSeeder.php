<?php

namespace Database\Seeders;

use App\Models\PermissionList;
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
            'permission-management.create',
            'permission-management.edit',
            'permission-management.view',
            'permission-management.delete',
            'user-management.create',
            'user-management.edit',
            'user-management.view',
            'user-management.delete',

            'pending-candidates.create',
            'pending-candidates.edit',
            'pending-candidates.view',
            'pending-candidates.delete',

            'selected-candidates.create',
            'selected-candidates.edit',
            'selected-candidates.view',
            'selected-candidates.delete',

            'rejected-candidates.create',
            'rejected-candidates.edit',
            'rejected-candidates.view',
            'rejected-candidates.delete',
            
            'selected-candidates-under-condition.create',
            'selected-candidates-under-condition.edit',
            'selected-candidates-under-candidates.view',
            'selected-candidates-under-candidates.delete',

            'application.create',
            'application.edit',
            'application.view',
            'application.delete',

            'application-download.create',
            'application-download.edit',
            'application-download.view',
            'application-download.delete',

            'assesment-form-send.create',
            'assesment-form-send.edit',
            'assesment-form-send.view',
            'assesment-form-send.delete',

            'assesment-form-email.create',
            'assesment-form-email.edit',
            'assesment-form-email.view',
            'assesment-form-email.delete',

            'assesment-form-download.create',
            'assesment-form-download.edit',
            'assesment-form-download.view',
            'assesment-form-download.delete',

            'application-reverse.create',
            'application-reverse.edit',
            'application-reverse.view',
            'application-reverse.delete',

            'email-send.create',
            'email-send.edit',
            'email-send.view',
            'email-send.delete',

            'smtp-setting.create',
            'smtp-setting.edit',
            'smtp-setting.view',
            'smtp-setting.delete',
        ];

        foreach($permission_info as $permission){
            Permission::create(['name' => $permission]);
        }

        $permission_list = [
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

        foreach($permission_list as $permission){
            PermissionList::create([
                'name' => $permission,
            ]);
        }

        
    }
}
