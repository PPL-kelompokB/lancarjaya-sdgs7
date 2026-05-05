<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 🔥 RELASI
use App\Models\Donation;
use App\Models\Organization;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'role',
        'profile_photo', // 🔥 upload foto
        'points',        // 🔥 poin reward
    ];

    /**
     * Hidden fields
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Default value
     */
    protected $attributes = [
        'points' => 0,
    ];

    /**
     * 🔥 RELASI: User punya 1 organization
     */
    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    /**
     * 🔥 RELASI: User punya banyak donasi
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * 🔥 ACCESSOR: URL foto profil
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : 'https://via.placeholder.com/100';
    }
}