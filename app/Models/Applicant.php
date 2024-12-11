<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
   protected $table ="applicants";
   protected $guarded = [];

   public function user(){
    return $this->belongsTo(User::class);
   }
   public function CvReview()
   {
       return $this->hasOne(CvReview::class);
   }
}
