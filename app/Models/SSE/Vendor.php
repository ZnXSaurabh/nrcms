<?php

namespace App\Models\SSE;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'sup_cat_id',
        'email',
        'mobile',
        'agreement_no',
        'photo',
        'remarks',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
