<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'location_id',
        'area_id',
        'housetype_id',
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

    public function housetype()
    {
        return $this->belongsTo(Housetype::class);
    }
}
