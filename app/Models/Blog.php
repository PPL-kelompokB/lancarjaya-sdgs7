<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'organization_id',
        'title',
        'content'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}