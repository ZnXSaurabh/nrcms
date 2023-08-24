<?php

namespace App\Models;

use App\User;
use App\Models\SSE\AllocateJob;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'comp_type',
        'comp_id',
        'location_id',
        'area_id',
        'service_building_id',
        'sup_cat_id',
        'category_id',
        'sub_category_id',
        'description',
        'images',
        'job_allocation_id',
        'resolution',
        'resolution_images',
        'resolution_date',
        'feedback',
        'satisfaction_level',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function service_building()
    {
        return $this->belongsTo(ServiceBuilding::class);
    }

    public function allocateJob()
    {
        return $this->hasOne(AllocateJob::class);
    }
}
