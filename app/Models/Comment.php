<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerComment extends Model
{
    protected $fillable = [
        'user_id',
<<<<<<< HEAD
        'blog_id',
        'comment'
=======
        'commentable_type',
        'commentable_id',
        'body',
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD
    public function blog()
    {
        return $this->belongsTo(Blog::class);
=======
    public function commentable()
    {
        return $this->morphTo();
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
    }
}