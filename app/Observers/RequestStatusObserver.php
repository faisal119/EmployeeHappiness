<?php

namespace App\Observers;

use App\Models\RequestStatistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequestStatusObserver
{
    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        try {
            // تحقق مما إذا تم تغيير الحالة
            if ($model->wasChanged('status')) {
                $oldStatus = $model->getOriginal('status');
                $newStatus = $model->status;
                
                Log::info('🔄 تم اكتشاف تغيير في حالة الطلب:', [
                    'model_type' => get_class($model),
                    'request_id' => $model->id,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus
                ]);

                // التحقق من تسجيل دخول المشرف
                $admin_id = Auth::guard('admin')->id();
                if (!$admin_id) {
                    Log::error('❌ لم يتم العثور على معرف المشرف في الجلسة');
                    return;
                }

                // تحديد نوع الطلب
                $requestType = match (get_class($model)) {
                    'App\Models\InsuranceRequest' => 'insurance',
                    'App\Models\ResidencyRequest' => 'residency',
                    'App\Models\DiscountCardRequest' => 'discount-card',
                    default => null
                };

                if (!$requestType) {
                    Log::error('❌ نوع الطلب غير معروف:', ['model_class' => get_class($model)]);
                    return;
                }

                // إنشاء سجل إحصائي جديد
                $statistic = new RequestStatistic();
                $statistic->admin_id = $admin_id;
                $statistic->request_id = $model->id;
                $statistic->request_type = $requestType;
                $statistic->action_type = $newStatus;
                $statistic->save();

                Log::info('✅ تم إنشاء سجل إحصائي جديد:', [
                    'statistic_id' => $statistic->id,
                    'admin_id' => $admin_id,
                    'request_id' => $model->id,
                    'request_type' => $requestType,
                    'action_type' => $newStatus
                ]);
            }
        } catch (\Exception $e) {
            Log::error('❌ خطأ في مراقب حالة الطلب:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
} 