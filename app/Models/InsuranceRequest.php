<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'military_id',
        'unified_number',
        'phone',
        'service_type',
        'description',
        'status',
        'update_reason',
        'relation_type',
        'marital_status',
        'hiring_date',
        'passport',
        'id_card',
        'photo',
        'residency',
        'marriage_contract',
        'birth_certificate',
        'family_book',
        'child_name',
        'notes'
    ];

    protected $dates = [
        'hiring_date',
        'created_at',
        'updated_at'
    ];
}
   