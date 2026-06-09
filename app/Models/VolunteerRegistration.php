<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRegistration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function volunteerRequest()
    {
        return $this->belongsTo(
            VolunteerRequest::class,
            'volunteer_id'
        );
    }


    public function reviews()
    {
        return $this->hasMany(
            VolunteerReview::class,
            'volunteer_registration_id'
        );
    }
}