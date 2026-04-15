<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'title',
        'description',
        'code',
        'discount_type',
        'discount_value',
        'points_cost',
        'quota',
        'used_count',
        'start_date',
        'end_date',
        'status',
        'image',
    ];
}