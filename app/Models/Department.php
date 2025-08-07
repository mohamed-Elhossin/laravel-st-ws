<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = "departments";
    protected $guarded = [];

        public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
