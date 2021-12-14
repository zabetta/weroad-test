<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tours;

class Travel extends Model
{
    use Uuids;
    use HasFactory;

    protected $table = 'travels';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'number_of_days',
        'moods',
    ];

    public function tours(){
        return $this->hasMany(Tour::class)->get();
    }
    protected $casts = [
        'id' => 'string'
    ];
}
