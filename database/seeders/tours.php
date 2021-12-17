<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\Tour;

class tours extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        $json = Storage::disk('local')->get('tours.json');

        $tours = json_decode($json);
  
        foreach ($tours as $key => $value) {
            Tour::create([
                "id" => $value->id,
                "travelId" => $value->travelId,
                "name" => $value->name,
                "startingDate" => $value->startingDate,
                "endingDate" => $value->endingDate,
                "price" => $value->price,
            ]);
        }
    }
}
