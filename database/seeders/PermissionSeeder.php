<?php

namespace Database\Seeders;

use App\Models\PermissionList;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

            //request
            'pending-request.view',
            'selected-request.view',
            'rejected-request.view',
            'rejected-request.rollback',
            'selected-under-condition-request.view',
            'selected-under-condition-request.rollback',

            //cpf form
            'pending-request.accept',
            'cpf.view',
            'cpf.download',

            //assestment form
            'assestment-form.download',
    
            //email-send
            'email-send.create',

            //Roll management
            'role.create',
            'role.view',

            //user management
            'user.create',
            'user.view',
            'user.edit',
            'user.active/deactive',

            //permission
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.remove',

            //agent
            'agent.view',
            'agent.create',

            //smtp settings
            'smtp-setting.create',
            'smtp-setting.edit',
            'smtp-setting.view',

            //course
            'course.create',
            'course.view',
            'course.edit',
            'course.active/deactive',

            //User - courses
            'user-course.create',
            'user-course.edit',
            'user-course.view',
            'user-course.remove',
        ];

        foreach($permission_info as $permission){
            Permission::create(['name' => $permission]);
        }

        $permission_list = [
            'pending-request' => ['catagory' => 'pending-request', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '1'],
            
            'selected-request' => ['catagory' => 'selected-request', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'rejected-request' => ['catagory' => 'rejected-request', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '1', 'active/deactive' => '0', 'accept' => '0'],
            
            'selected-under-condition-request' => ['catagory' => 'selected-under-condition-request', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '1', 'active/deactive' => '0', 'accept' => '0'],

            'cpf' => ['catagory' => 'cpf', 'view' => '1', 'download' => '1', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'assestment-form' => ['catagory' => 'assestment-form', 'view' => '0', 'download' => '1', 'edit' => '0', 'create' => '0',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'email-send' => ['catagory' => 'email-send', 'view' => '0', 'download' => '0', 'edit' => '0', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'role' => ['catagory' => 'role', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'user' => ['catagory' => 'user', 'view' => '1', 'download' => '0', 'edit' => '1', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '1', 'accept' => '0'],
            
            'permission' => ['catagory' => 'permission', 'view' => '1', 'download' => '0', 'edit' => '1', 'create' => '1',  'remove' => '1', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
            'agent' => ['catagory' => 'agent', 'view' => '1', 'download' => '0', 'edit' => '0', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],

            'smtp-setting' => ['catagory' => 'smtp-setting', 'view' => '1', 'download' => '0', 'edit' => '1', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],

            'course' => ['catagory' => 'course', 'view' => '1', 'download' => '0', 'edit' => '1', 'create' => '1',  'remove' => '0', 'rollback' => '0', 'active/deactive' => '1', 'accept' => '0'],
            
            'user-course' => ['catagory' => 'user-course', 'view' => '1', 'download' => '0', 'edit' => '1', 'create' => '1',  'remove' => '1', 'rollback' => '0', 'active/deactive' => '0', 'accept' => '0'],
            
        ];

        foreach($permission_list as $permission){
            
                PermissionList::create([
                    'name' => $permission['catagory'],
                    'view' => $permission['view'],
                    'edit' => $permission['edit'],
                    'accept' => $permission['accept'],
                    'remove' => $permission['remove'],
                    'rollback' => $permission['rollback'],
                    'download' => $permission['download'],
                    'create' => $permission['create'],
                    'active_deactive' => $permission['active/deactive'],
                ]);
            
        }

        //permission
        $permissions = [
            'Agent1' => ['role' => 'Agent', 'permission' => 'agent.create'],
            'Agent2' => ['role' => 'Agent', 'permission' => 'pending-request.view'],
            'Agent3' => ['role' => 'Agent', 'permission' => 'selected-request.view'],
            'Agent4' => ['role' => 'Agent', 'permission' => 'rejected-request.view'],
            'Agent5' => ['role' => 'Agent', 'permission' => 'selected-under-condition-request.view'],
        ];

        foreach($permissions as $per){
            $role = Role::where('name', $per['role'])->first();
            $role->givePermissionTo($per['permission']); 
        }
    }
}
