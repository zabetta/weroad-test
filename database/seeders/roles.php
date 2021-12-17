<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\Role;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('roles.json');
        $roles = json_decode($json);

        foreach ($roles as $key => $value) {
            Role::create([
                "id" => $value->id,
                "name" => $value->name
            ]);
        }
    }
}
