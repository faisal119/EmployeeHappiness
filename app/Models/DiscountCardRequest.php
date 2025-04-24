<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCardRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'employee_id',
        'age',
        'card_type',
        'email',
        'emirate',
        'area',
        'father_alive',
        'mother_alive',
        'previous_card',
        'married',
        'children_count',
        'passport_copy',
        'emirates_id',
        'status',
        'notes'
    ];
} 