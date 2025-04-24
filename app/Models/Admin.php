<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // التحقق من أن المشرف نشط
    public function isActive()
    {
        return !$this->trashed();
    }

    // العلاقة مع إحصائيات الطلبات
    public function statistics()
    {
        return $this->hasMany(RequestStatistic::class);
    }

    // العلاقة مع سجلات الدخول
    public function loginLogs()
    {
        return $this->hasMany(AdminLoginLog::class);
    }

    // الحصول على آخر تسجيل دخول
    public function getLastLoginAttribute()
    {
        return $this->loginLogs()->latest('login_at')->first();
    }

    // الحصول على إحصائيات المشرف
    public function getStatisticsData()
    {
        return [
            'total_requests' => $this->statistics()->count(),
            'approved_requests' => $this->statistics()->where('action_type', 'approved')->count(),
            'rejected_requests' => $this->statistics()->where('action_type', 'rejected')->count(),
            'pending_requests' => $this->statistics()->where('action_type', 'pending')->count(),
            'last_login' => $this->last_login ? $this->last_login->login_at->format('Y-m-d H:i:s') : null,
            'last_activity' => $this->statistics()->latest()->first()?->created_at->format('Y-m-d H:i:s')
        ];
    }
}
