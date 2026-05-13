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

        // VALIDATION
        'validation_status',
        'validation_note',
    ];

    /**
     * Relasi ke User
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
}