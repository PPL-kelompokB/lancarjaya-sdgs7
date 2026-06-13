<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationSubmission extends Model
{
    use HasFactory;

    protected $fillable = [

        'donation_id',
        'user_id',
        'item_name',
        'quantity',
        'unit',
        'pickup_address',
        'phone_number',
        'pickup_date',
        'notes',
        'pickup_proof_image',
        'status',
        'rejection_note',
    ];

    /**
     * Relationship to donation campaign
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    /**
     * Relationship to donor user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}