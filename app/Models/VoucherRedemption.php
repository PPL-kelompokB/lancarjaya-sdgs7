<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VoucherRedemption extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'points_spent',
        'redemption_code',
        'status',
        'redeemed_at',
        'used_at',
        'expired_at',
    ];

    protected $casts = [
        'redeemed_at' => 'datetime',
        'used_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * Generate unique redemption code
     */
    public static function generateRedemptionCode()
    {
        do {
            $code = 'RDM-' . strtoupper(Str::random(8));
        } while (self::where('redemption_code', $code)->exists());

        return $code;
    }

    /**
     * Check if voucher is still valid
     */
    public function isValid()
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->expired_at && $this->expired_at < now()) {
            return false;
        }

        return true;
    }

    /**
     * Mark voucher as used
     */
    public function markAsUsed()
    {
        $this->status = 'used';
        $this->used_at = now();
        $this->save();
    }

    /**
     * Mark voucher as expired
     */
    public function markAsExpired()
    {
        $this->status = 'expired';
        $this->expired_at = now();
        $this->save();
    }
}
