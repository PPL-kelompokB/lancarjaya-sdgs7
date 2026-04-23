<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;

class VolunteerRequest extends Model
{
    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'task_description',
        'required_skills',
        'volunteer_quota',
        'deadline',
        'event_date',
        'event_type',
        'location',
        'location_radius',
        'notes',
        'image',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}