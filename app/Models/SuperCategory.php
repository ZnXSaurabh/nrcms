<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperCategory extends Model
{
    protected $fillable = [
        'name',
        'icons',
        'description'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
