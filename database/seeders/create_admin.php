<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\role_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class create_admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');

        $adminRole = Role::where('name', 'admin')->firstOrFail();

        $user = User::create([
            'email' => 'admin@weroad.it',
            'password' => $password
        ]);

        $role_user = role_user::create([
            'user_id' => $user->id,
            'role_id' => $adminRole->id
        ]);
    }
}
