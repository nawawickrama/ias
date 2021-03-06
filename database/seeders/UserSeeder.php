<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ias',
            'email' => 'ias@ias.com',
            'password' => Hash::make('password'),
            'status' => 1,
        ]);

        $user = User::find(1);
        $user->assignRole('Super Admin');
    }
}
