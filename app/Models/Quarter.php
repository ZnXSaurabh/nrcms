<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    protected $fillable = [
        'location_id',
        'area_id',
        'housetype_id',
        'block_id',
        'qtrno',
        'quarter_id',
        'rent',
        'house_area',
        'garages',
        'remarks',
        'status',
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

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
