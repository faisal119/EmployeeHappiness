<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\RequestStatistic;
use App\Models\ResidencyRequest;
use App\Models\InsuranceRequest;
use App\Models\DiscountCardRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    public function index()
    {
        try {
            Log::info('📊 بدء جلب الإحصائيات');
            
            // جلب جميع المشرفين مع إحصائياتهم
            $admins = Admin::select(
                'admins.id',
                'admins.name'
            )->get();

            Log::info('تم جلب المشرفين', ['count' => $admins->count()]);

            foreach ($admins as $admin) {
                // إحصائيات الطلبات المعالجة
                $stats = RequestStatistic::where('admin_id', $admin->id)
                    ->select(
                        DB::raw('COUNT(DISTINCT request_id) as total_requests'),
                        DB::raw('SUM(CASE WHEN action_type = "approved" THEN 1 ELSE 0 END) as approved_requests'),
                        DB::raw('SUM(CASE WHEN action_type = "rejected" THEN 1 ELSE 0 END) as rejected_requests')
                    )
                    ->first();

                Log::info('إحصائيات المشرف', [
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name,
                    'stats' => $stats
                ]);

                $admin->total_requests = $stats->total_requests ?? 0;
                $admin->approved_requests = $stats->approved_requests ?? 0;
                $admin->rejected_requests = $stats->rejected_requests ?? 0;

                // تفاصيل آخر الطلبات المعالجة
                $admin->recent_transactions = RequestStatistic::where('admin_id', $admin->id)
                    ->with(['residencyRequest', 'insuranceRequest', 'discountCardRequest'])
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get()
                    ->map(function ($stat) {
                        $request = null;
                        $requestType = '';

                        switch ($stat->request_type) {
                            case 'residency':
                                $request = $stat->residencyRequest;
                                $requestType = 'طلب إقامة';
                                break;
                            case 'insurance':
                                $request = $stat->insuranceRequest;
                                $requestType = 'طلب تأمين';
                                break;
                            case 'discount-card':
                                $request = $stat->discountCardRequest;
                                $requestType = 'طلب بطاقة خصم';
                                break;
                        }

                        return [
                            'request_id' => $stat->request_id,
                            'request_type' => $requestType,
                            'old_status' => 'قيد المراجعة',
                            'new_status' => $this->getStatusInArabic($stat->action_type),
                            'created_at' => $stat->created_at,
                            'notes' => '',
                            'applicant_name' => $request ? $request->name : 'غير متوفر',
                            'military_id' => $request ? $request->military_id : 'غير متوفر'
                        ];
                    });

                Log::info('تم جلب المعاملات الأخيرة للمشرف', [
                    'admin_id' => $admin->id,
                    'transactions_count' => $admin->recent_transactions->count()
                ]);
            }

            // إجمالي الإحصائيات
            $totalStats = RequestStatistic::select(
                DB::raw('COUNT(DISTINCT request_id) as total_requests'),
                DB::raw('SUM(CASE WHEN action_type = "approved" THEN 1 ELSE 0 END) as approved_requests'),
                DB::raw('SUM(CASE WHEN action_type = "rejected" THEN 1 ELSE 0 END) as rejected_requests')
            )->first();

            Log::info('✅ تم جلب الإحصائيات بنجاح', [
                'total_admins' => $admins->count(),
                'total_requests' => $totalStats->total_requests ?? 0,
                'approved_requests' => $totalStats->approved_requests ?? 0,
                'rejected_requests' => $totalStats->rejected_requests ?? 0
            ]);

            return view('admin.statistics', [
                'admins' => $admins,
                'totalRequests' => $totalStats->total_requests ?? 0,
                'approvedRequests' => $totalStats->approved_requests ?? 0,
                'rejectedRequests' => $totalStats->rejected_requests ?? 0
            ]);

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في جلب الإحصائيات:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'حدث خطأ أثناء جلب الإحصائيات. الرجاء المحاولة مرة أخرى.');
        }
    }

    private function getStatusInArabic($status)
    {
        return [
            'pending' => 'قيد المراجعة',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض'
        ][$status] ?? $status;
    }
} 