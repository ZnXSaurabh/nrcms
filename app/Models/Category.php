<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'sup_cat_id',
        'name',
        'icons',
        'description'
    ];

    public function supercategory()
    {
        return $this->belongsTo(SuperCategory::class, 'sup_cat_id');
    }
    
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
