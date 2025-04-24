<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AdminLoginLog extends Model
{
    protected $fillable = [
        'admin_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at'
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public static function recordLogin($admin, $request)
    {
        try {
            $log = self::create([
                'admin_id' => $admin->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now()
            ]);

            Log::info('✅ تم تسجيل دخول المشرف في قاعدة البيانات:', [
                'admin_id' => $admin->id,
                'login_log_id' => $log->id
            ]);

            return $log;
        } catch (\Exception $e) {
            Log::error('❌ خطأ في تسجيل دخول المشرف:', [
                'admin_id' => $admin->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function recordLogout()
    {
        try {
            $this->update([
                'logout_at' => now()
            ]);

            Log::info('✅ تم تسجيل خروج المشرف في قاعدة البيانات:', [
                'admin_id' => $this->admin_id,
                'login_log_id' => $this->id
            ]);
        } catch (\Exception $e) {
            Log::error('❌ خطأ في تسجيل خروج المشرف:', [
                'admin_id' => $this->admin_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
} 