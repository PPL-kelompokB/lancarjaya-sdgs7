<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
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
     * Relasi ke Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}