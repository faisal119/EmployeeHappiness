<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'military_number',
        'suggestion',
        'status',
        'admin_notes'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
} 