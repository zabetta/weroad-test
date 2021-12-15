<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
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

        $user = [
            'name' => 'admin',
            'email' => 'admin@mweroad.com',
            'password' => $password,
            'role_id' => $adminRole->id
        ];
        
        User::create($user);

    }
}
