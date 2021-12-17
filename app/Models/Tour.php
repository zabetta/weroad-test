<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Travel;

class Tour extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'travel_id',
        'name',
        'starting_date',
        'ending_date',
        'price'
    ];

    public function getTravel(){
        return $this->belongsTo(Travel::class, 'travel_id', 'id');
    }
}
