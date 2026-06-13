<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherRedemption extends Model
{
    protected $fillable = [
    'user_id',
    'voucher_id',
    'points_spent',
    'redemption_code',
    'status',
    'redeemed_at',
    'expired_at',
    ];

    public static function generateRedemptionCode()
    {
        return 'VCR-' . strtoupper(substr(md5(uniqid()), 0, 8));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}