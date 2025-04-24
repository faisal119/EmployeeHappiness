<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceRequest;
use App\Models\ResidencyRequest;
use App\Models\DiscountCardRequest;
use App\Models\RequestStatistic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        Log::info('🟢 بداية تحميل لوحة التحكم');

        try {
            // التحقق من تسجيل دخول المشرف
            if (!Auth::guard('admin')->check()) {
                Log::error('❌ المستخدم غير مسجل دخول كمشرف');
                return redirect()->route('admin.login')->with('error', 'يجب تسجيل الدخول كمشرف');
            }

            $admin = Auth::guard('admin')->user();
            Log::info('✅ تم التحقق من المشرف:', [
                'admin_id' => $admin->id,
                'admin_name' => $admin->name
            ]);

            // جمع الإحصائيات
            try {
                $statistics = [
                    'insurance' => [
                        'total' => InsuranceRequest::count(),
                        'pending' => InsuranceRequest::where('status', 'pending')->count(),
                        'approved' => InsuranceRequest::where('status', 'approved')->count(),
                        'rejected' => InsuranceRequest::where('status', 'rejected')->count(),
                    ],
                    'residency' => [
                        'total' => ResidencyRequest::count(),
                        'pending' => ResidencyRequest::where('status', 'pending')->count(),
                        'approved' => ResidencyRequest::where('status', 'approved')->count(),
                        'rejected' => ResidencyRequest::where('status', 'rejected')->count(),
                    ],
                    'discount_card' => [
                        'total' => DiscountCardRequest::count(),
                        'pending' => DiscountCardRequest::where('status', 'pending')->count(),
                        'approved' => DiscountCardRequest::where('status', 'approved')->count(),
                        'rejected' => DiscountCardRequest::where('status', 'rejected')->count(),
                    ]
                ];

                Log::info('✅ تم جمع إحصائيات الطلبات بنجاح');

                // جمع إحصائيات المشرف
                $adminStats = [
                    'total_processed' => RequestStatistic::where('admin_id', $admin->id)->count(),
                    'approved' => RequestStatistic::where('admin_id', $admin->id)
                        ->where('action_type', 'approved')->count(),
                    'rejected' => RequestStatistic::where('admin_id', $admin->id)
                        ->where('action_type', 'rejected')->count(),
                    'pending' => RequestStatistic::where('admin_id', $admin->id)
                        ->where('action_type', 'pending')->count(),
                    'last_login' => $admin->last_login ? $admin->last_login->login_at->format('Y-m-d H:i:s') : 'لم يتم تسجيل الدخول بعد',
                    'last_activity' => RequestStatistic::where('admin_id', $admin->id)
                        ->latest()->first()?->created_at?->format('Y-m-d H:i:s') ?? 'لا يوجد نشاط'
                ];

                Log::info('✅ تم جمع إحصائيات المشرف بنجاح');

                // جلب آخر 5 طلبات تم معالجتها
                $recentActivities = RequestStatistic::with(['insuranceRequest', 'residencyRequest', 'discountCardRequest'])
                    ->where('admin_id', $admin->id)
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($stat) {
                        $request = $stat->insuranceRequest ?? $stat->residencyRequest ?? $stat->discountCardRequest;
                        return [
                            'request_id' => $stat->request_id,
                            'request_type' => $this->getRequestTypeInArabic($stat->request_type),
                            'action_type' => $this->getActionTypeInArabic($stat->action_type),
                            'created_at' => $stat->created_at->format('Y-m-d H:i:s'),
                            'applicant_name' => $request ? $request->full_name : 'غير متوفر',
                            'military_id' => $request ? $request->military_id : 'غير متوفر'
                        ];
                    });

                Log::info('✅ تم جلب آخر النشاطات بنجاح');

                // التحقق من وجود ملف العرض
                if (!view()->exists('admin.dashboard')) {
                    throw new \Exception('ملف العرض غير موجود: admin.dashboard');
                }

                return view('admin.dashboard', compact('statistics', 'adminStats', 'recentActivities'));

            } catch (\Exception $e) {
                Log::error('❌ خطأ في جمع البيانات:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في عرض لوحة التحكم:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('admin.login')
                ->with('error', 'حدث خطأ أثناء تحميل لوحة التحكم. الرجاء المحاولة مرة أخرى.');
        }
    }

    private function getRequestTypeInArabic($type)
    {
        return match($type) {
            'insurance' => 'تأمين صحي',
            'residency' => 'إقامة',
            'discount_card' => 'بطاقة خصم',
            default => $type
        };
    }

    private function getActionTypeInArabic($action)
    {
        return match($action) {
            'approved' => 'مقبول',
            'rejected' => 'مرفوض',
            'pending' => 'قيد المراجعة',
            default => $action
        };
    }
} 