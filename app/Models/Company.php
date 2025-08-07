<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "companies";
    protected $guarded = [];

     public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
