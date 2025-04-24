<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsuranceRequest;
use App\Models\ResidencyRequest;
use App\Models\DiscountCardRequest;
use App\Models\RequestStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdateNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        Log::info('🟢 بداية تنفيذ دالة index');
        
        try {
            $category = $request->query('category', 'insurance'); // افتراضياً 'insurance' إذا لم يتم تحديد الفئة
            Log::info('🟢 الفئة المطلوبة:', ['category' => $category]);
            
            switch($category) {
                case 'discount-card':
                    // جلب طلبات بطاقات الخصم
                    $requests = DiscountCardRequest::orderBy('created_at', 'desc')->get();
                    Log::info('🟢 تم جلب طلبات بطاقات الخصم:', [
                        'عدد الطلبات' => $requests->count()
                    ]);
                    break;
                case 'residency':
                    // جلب طلبات الإقامة
                    $requests = ResidencyRequest::orderBy('created_at', 'desc')->get();
                    Log::info('🟢 تم جلب طلبات الإقامة:', [
                        'عدد الطلبات' => $requests->count()
                    ]);
                    break;
                default:
                    // جلب طلبات التأمين
                    $requests = InsuranceRequest::orderBy('created_at', 'desc')->get();
                    Log::info('🟢 تم جلب طلبات التأمين:', [
                        'عدد الطلبات' => $requests->count()
                    ]);
                    break;
            }

            // عرض الصفحة
            Log::info('🟢 عرض صفحة الطلبات');
            return view('admin.requests', compact('requests', 'category'));

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في جلب الطلبات:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return redirect()->back()->with('error', 'حدث خطأ أثناء جلب الطلبات');
        }
    }

    public function show($id)
    {
        Log::info('🟢 بداية تنفيذ دالة عرض تفاصيل الطلب', [
            'id' => $id,
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'user_agent' => request()->userAgent()
        ]);
        
        try {
            // التحقق من تسجيل دخول المشرف
            if (!auth('admin')->check()) {
                Log::error('❌ المستخدم غير مسجل دخول كمشرف');
                return redirect()->route('admin.login')->with('error', 'يجب تسجيل الدخول كمشرف');
            }

            // الحصول على نوع الطلب من الرابط
            $category = request()->query('category');
            
            if (empty($category)) {
                Log::error('❌ لم يتم تحديد نوع الطلب في الرابط');
                return redirect()->route('admin.requests')->with('error', 'يجب تحديد نوع الطلب');
            }

            Log::info('معلومات الطلب المطلوب:', [
                'category' => $category,
                'id' => $id
            ]);

            // التحقق من صحة نوع الطلب
            if (!in_array($category, ['insurance', 'residency', 'discount-card'])) {
                Log::error('❌ نوع الطلب غير صالح:', ['category' => $category]);
                return redirect()->route('admin.requests')->with('error', 'نوع الطلب غير صالح');
            }

            // البحث عن الطلب
            $request = match($category) {
                'insurance' => InsuranceRequest::findOrFail($id),
                'residency' => ResidencyRequest::findOrFail($id),
                'discount-card' => DiscountCardRequest::findOrFail($id)
            };

            Log::info('✅ تم العثور على الطلب بنجاح:', [
                'id' => $request->id,
                'type' => $category,
                'status' => $request->status,
                'created_at' => $request->created_at
            ]);

            // تحقق من وجود ملف العرض
            $viewPath = 'admin.request-details';
            if (!view()->exists($viewPath)) {
                Log::error('❌ ملف العرض غير موجود:', ['view' => $viewPath]);
                throw new \Exception('ملف العرض غير موجود');
            }

            Log::info('🟢 عرض تفاصيل الطلب:', [
                'view' => $viewPath,
                'request_id' => $request->id,
                'category' => $category
            ]);

            return view($viewPath, [
                'request' => $request,
                'category' => $category
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('❌ الطلب غير موجود:', [
                'id' => $id,
                'category' => $category ?? 'غير محدد',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.requests')
                ->with('error', 'الطلب غير موجود');
                
        } catch (\Exception $e) {
            Log::error('🔴 خطأ غير متوقع:', [
                'id' => $id,
                'category' => $category ?? 'غير محدد',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            // في بيئة التطوير، نعرض تفاصيل الخطأ
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->route('admin.requests')
                ->with('error', 'حدث خطأ أثناء عرض تفاصيل الطلب. الرجاء المحاولة مرة أخرى');
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            Log::info('🟢 بداية تحديث حالة الطلب:', [
                'request_data' => $request->all(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ]);

            // التحقق من تسجيل دخول المشرف
            if (!Auth::guard('admin')->check()) {
                Log::error('🔴 فشل التحقق من المشرف');
                return redirect()->back()->with('error', 'يجب تسجيل دخول كمشرف');
            }

            // التحقق من البيانات
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:pending,approved,rejected',
                'category' => 'required|in:insurance,residency,discount-card',
                'id' => 'required|integer',
                'notes' => 'nullable|string|max:1000'
            ]);

            if ($validator->fails()) {
                Log::error('🔴 فشل التحقق من البيانات', [
                    'errors' => $validator->errors()->toArray()
                ]);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {
                // البحث عن الطلب
                $model = match ($request->category) {
                    'insurance' => InsuranceRequest::class,
                    'residency' => ResidencyRequest::class,
                    'discount-card' => DiscountCardRequest::class,
                };

                $requestModel = $model::findOrFail($request->id);
                
                Log::info('🟢 تم العثور على الطلب:', [
                    'model' => $model,
                    'id' => $requestModel->id,
                    'old_status' => $requestModel->status,
                    'category' => $request->category
                ]);

                // تحديث حالة الطلب
                $oldStatus = $requestModel->status;
                $requestModel->update([
                    'status' => $request->status,
                    'notes' => $request->notes
                ]);

                Log::info('✅ تم تحديث حالة الطلب:', [
                    'request_id' => $requestModel->id,
                    'old_status' => $oldStatus,
                    'new_status' => $requestModel->status,
                    'category' => $request->category
                ]);

                // إرسال إشعار للمستخدم
                try {
                    if ($requestModel->email) {
                        Mail::to($requestModel->email)
                            ->queue(new StatusUpdateNotification($requestModel));
                        
                        Log::info('✉️ تم إرسال إشعار البريد الإلكتروني', [
                            'email' => $requestModel->email
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('❌ خطأ في إرسال الإشعار:', [
                        'error' => $e->getMessage(),
                        'email' => $requestModel->email ?? null
                    ]);
                    // لا نريد إيقاف العملية إذا فشل إرسال الإشعار
                }

                DB::commit();
                
                return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');

            } catch (\Exception $e) {
                DB::rollback();
                Log::error('🔴 خطأ في عملية التحديث:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث حالة الطلب');
            }
        } catch (\Exception $e) {
            Log::error('🔴 خطأ عام:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع');
        }
    }

    private function getStatusInArabic($status)
    {
        return match ($status) {
            'pending' => 'قيد المراجعة',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض',
            default => $status
        };
    }
} 