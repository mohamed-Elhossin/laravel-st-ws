<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveUsage extends Model
{
    

    protected $fillable = [
        'start_date',
        'end_date',
        'type',
        'reason',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
