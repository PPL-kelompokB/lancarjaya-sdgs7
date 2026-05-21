<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    // Isikan nama tabel jika tidak sesuai konvensi plural (opsional)
    // protected $table = 'volunteers';

    // Izinkan mass assignment (opsional, sesuaikan dengan kebutuhanmu)
    protected $guarded = [];
}