<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'total',
        'urgent_days',
        'normal_days',
        'sick_days',
        'employee_id',
    ];
    protected $casts = [
        'total' => 'integer',
        'urgent_days' => 'integer',
        'normal_days' => 'integer',
        'sick_days' => 'integer',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
