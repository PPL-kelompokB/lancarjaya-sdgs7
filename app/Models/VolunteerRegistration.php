<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'name',
        'email',
        'cv_path',
    ];

    public function volunteer()
    {
        return $this->belongsTo(VolunteerRequest::class, 'volunteer_id');
    }
}
