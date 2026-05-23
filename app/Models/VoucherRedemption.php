<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Donation;
use App\Models\VolunteerRequest;
use App\Models\Blog;

class User extends Authenticatable
{
    // kode lama kamu...

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function volunteerRequests()
    {
        return $this->hasMany(VolunteerRequest::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}