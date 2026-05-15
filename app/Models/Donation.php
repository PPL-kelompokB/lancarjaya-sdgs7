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
<<<<<<< HEAD
        }

    public function organization()
        {
            return $this->belongsTo(Organization::class);
        }
}
=======
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
>>>>>>> 49b0fcc4eb28c8626a36b75eb9e3a73d851e5315
