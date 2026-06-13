<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    // USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // VOLUNTEER REGISTRATION
    public function registration()
    {
        return $this->belongsTo(
            VolunteerRegistration::class,
            'volunteer_registration_id'
        );
    }

    // VOLUNTEER REQUEST
    public function volunteerRequest()
    {
        return $this->belongsTo(
            VolunteerRequest::class,
            'volunteer_request_id'
        );
    }
}