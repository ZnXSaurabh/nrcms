<?php

namespace App\Models\SSE;

use Illuminate\Database\Eloquent\Model;

class AllocateJob extends Model
{
    protected $table = 'allocate_jobs';

    protected $fillable = [
        'complaint_id',
        'sse_id',
        'complaint_priority',
        'remark',
        'vendor_id',
        'resource_id',
        'estimated_days'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
