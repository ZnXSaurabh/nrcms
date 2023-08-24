<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escalation extends Model
{
    protected $fillable = [
        'department_id',
        'complaint_status',
        'l1_escalation_days',
        'l1_escalation_role',
        'l2_escalation_days',
        'l2_escalation_role',
        'l3_escalation_days',
        'l3_escalation_role'  
    ];
    
    public function subCategory()
    {
        return $this->hasOne(SuperCategory::class, 'id', 'department_id');
    }
}
