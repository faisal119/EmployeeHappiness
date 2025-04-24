<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidencyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'unified_number',
        'passport',
        'medical_result',
        'id_card',
        'salary_certificate',
        'photo',
        'service_type',
        'status',
        'notes',
        'military_id',
        'nationality',
        'pakistani_id',
        'employment_certificate',
        'current_residency',
        'sponsorship_transfer_certificate',
        'entry_permit',
        'acquaintance_document',
        'noc_letter'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    // تعريف القيم المسموحة لحقل الحالة
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    // تعريف القيم المسموحة لأنواع الخدمات
    public const TYPE_NEW_RESIDENCY = 'new-residency';
    public const TYPE_RENEW_RESIDENCY = 'renew-residency';
    public const TYPE_VISA_REQUEST = 'visa-request';
    public const TYPE_SPONSORSHIP_TRANSFER = 'sponsorship-transfer';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
