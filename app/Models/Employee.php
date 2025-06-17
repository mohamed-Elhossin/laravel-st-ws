<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = [
        'position',
        'salary',
        'join_date',
        'end_date',
        'user_id',
        'birth_date',
        'type',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function leaves()
    {
        return $this->hasOne(Leave::class, 'employee_id');
    }
    /**
     * Get the user that owns the employee.
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
