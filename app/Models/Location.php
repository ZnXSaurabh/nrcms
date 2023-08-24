<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
