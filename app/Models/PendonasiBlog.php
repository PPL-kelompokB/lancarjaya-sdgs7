<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendonasiBlog extends Model
{
    protected $table = 'pendonasi_blogs';

    protected $fillable = [
        'title',
        'content',
        'category',
        'tags',
        'image',
        'user_id',
        'status'
    ];
}