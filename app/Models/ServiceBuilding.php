<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBuilding extends Model
{
    protected $fillable = [
        'location_id',
        'area_id',
        'name',
        'area_covered',
        'address',
        'contact_no',
        'email',
        'status',
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
