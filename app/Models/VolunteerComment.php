<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerComment extends Model
{
    protected $fillable = [
        'user_id',
        'volunteer_request_id',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}