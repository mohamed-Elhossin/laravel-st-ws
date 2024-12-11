<?php

namespace App\Models;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;

class CvReview extends Model
{
    protected $table = "cv_reviews";
    protected $guarded = [];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
