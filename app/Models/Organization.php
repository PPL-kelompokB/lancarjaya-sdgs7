<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'address',
        'org_phone',
        'pic_name',
        'pic_email',
        'pic_phone',
        'founded_year',
        'description',
        'bank_name',
        'account_holder_name',
        'rekening_number',
        'verification_status',
        'verification_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
