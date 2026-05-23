<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoints extends Model
{
    protected $table = 'user_points';
    
    protected $fillable = [
        'user_id',
        'total_points',
        'used_points',
        'available_points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucherRedemptions()
    {
        return $this->hasMany(VoucherRedemption::class, 'user_id', 'user_id');
    }

    /**
     * Tambah poin ke user
     */
    public static function addPoints($userId, $points)
    {
        $userPoints = self::firstOrCreate(
            ['user_id' => $userId],
            ['total_points' => 0, 'used_points' => 0, 'available_points' => 0]
        );

        $userPoints->total_points += $points;
        $userPoints->available_points += $points;
        $userPoints->save();

        return $userPoints;
    }

    /**
     * Kurangi poin dari user
     */
    public static function deductPoints($userId, $points)
    {
        $userPoints = self::where('user_id', $userId)->first();
        
        if (!$userPoints || $userPoints->available_points < $points) {
            return false;
        }

        $userPoints->available_points -= $points;
        $userPoints->used_points += $points;
        $userPoints->save();

        return true;
    }
}
