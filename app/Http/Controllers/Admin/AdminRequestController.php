<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResidencyRequest;
use App\Models\RequestStatusLog;
use App\Notifications\StatusUpdateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminRequestController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:1000',
            'category' => 'required|in:residency,discount'
        ]);

        try {
            DB::beginTransaction();

            $residencyRequest = ResidencyRequest::findOrFail($id);
            $oldStatus = $residencyRequest->status;
            
            // تحديث حالة الطلب
            $residencyRequest->update([
                'status' => $validatedData['status'],
                'notes' => $validatedData['notes'],
                'updated_at' => now()
            ]);

            // تسجيل الإحصائيات
            $this->logStatusChange($residencyRequest, $oldStatus, $validatedData['status']);

            // إرسال إشعار للمستخدم
            if ($residencyRequest->email) {
                $this->sendStatusUpdateNotification($residencyRequest);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث حالة الطلب بنجاح',
                'request' => $residencyRequest
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('خطأ في تحديث حالة الطلب: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث حالة الطلب'
            ], 500);
        }
    }

    private function logStatusChange($request, $oldStatus, $newStatus)
    {
        RequestStatusLog::create([
            'request_id' => $request->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => auth()->id(),
            'notes' => $request->notes
        ]);
    }

    private function sendStatusUpdateNotification($request)
    {
        $statusArabic = [
            'pending' => 'قيد المراجعة',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض'
        ];

        $message = "عزيزي {$request->name}،\n";
        $message .= "تم تحديث حالة طلبك إلى: {$statusArabic[$request->status]}\n";
        
        if ($request->notes) {
            $message .= "ملاحظات: {$request->notes}\n";
        }

        // يمكن إضافة المزيد من التفاصيل حسب الحاجة
        Mail::to($request->email)->queue(new StatusUpdateNotification($request, $message));
    }
} 