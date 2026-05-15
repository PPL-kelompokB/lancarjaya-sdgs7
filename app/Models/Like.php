<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
<<<<<<< HEAD
        'likeable_id',
        'likeable_type'
    ];
=======
        'likeable_type',
        'likeable_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
}