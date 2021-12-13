<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\Travel;

class travels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = Storage::disk('local')->get('travels.json');

        $travels = json_decode($json);
  
        foreach ($travels as $key => $value) {
            Travel::create([
                "id" => $value->id,
                "slug" => $value->slug,
                "name" => $value->name,
                "description" => $value->description,
                "number_of_days" => $value->numberOfDays,
                "moods" => json_encode( $value->moods )
            ]);
        }

        // $json = Storage::disk('local')->get('travels.json');
        
        // $travels = json_decode($json, true);

        // foreach ($travels as $key => $value){
        //     dd($value);

        //     Travel::create([
        //         "id" => $travel->id,
        //         "slug" => $travel->slug,
        //         "name" => $travel->name,
        //         "description" => $travel->description,
        //         "number_of_days" => $travel->numberOfDays,
        //         "moods" => json_encode($travel->moods),
        //     ]);
        // }
    }
}
