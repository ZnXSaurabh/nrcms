<?php

namespace App\Models\SSE;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'email',
        'mobile',
        'address',
        'pfno',
        'esi_no',
        'category_id',
        // 'sub_category_id', //remove by gaurav baliyan
        'photo',
        'remarks',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
