<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'organization_id',
        'title',
        'description',
        'item_name',
        'category',
        'quantity',
        'unit',
        'address',
        'city',
        'province',
        'contact_person',
        'contact_phone',
        'start_date',
        'end_date',
        'status',
        'logistic_status',
    ];

    /**
     * Relasi ke User (pendonasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Relasi polymorphic ke Like
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Relasi polymorphic ke Comment
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
