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
     * Relasi ke Organization
     */
    public function dashboard()
        {
            $user = Auth::user();
            $donations = collect();

            return view('user.dashboard-user', compact('user', 'donations'));
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}