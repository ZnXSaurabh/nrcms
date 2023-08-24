<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Housetype extends Model
{
    protected $fillable = [
        'location_id',
        'area_id',
        'name',
        'description'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
