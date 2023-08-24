<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'fathername',
        'pfno',
        'department',
        'designation',
        'location_id',
        'area_id',
        'housetype_id',
        'block_id',
        'qtrno',
        'photo',
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
    
    public function quarter()
    {
        return $this->belongsTo(Quarter::class, 'qtrno');
    }
}
