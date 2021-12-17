<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\roles_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class createAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');

        $adminRole = Role::where('name','admin')->firstOrFail();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mweroad.com',
            'password' => $password
        ]);
        
        $role_user = roles_user::create([
            'user_id' => $user->id,
            'role_id' => $adminRole->id
        ]);

    }
}
