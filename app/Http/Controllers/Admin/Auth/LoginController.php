<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        Log::info('🟢 محاولة تسجيل دخول', [
            'email' => $request->email,
            'ip' => $request->ip()
        ]);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'password.required' => 'يرجى إدخال كلمة المرور'
        ]);

        try {
            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                
                try {
                    $loginLog = AdminLoginLog::recordLogin($admin, $request);
                    Log::info('✅ تم إنشاء سجل الدخول:', [
                        'login_log_id' => $loginLog ? $loginLog->id : null,
                        'admin_id' => $admin->id,
                        'ip' => $request->ip()
                    ]);
                } catch (\Exception $e) {
                    Log::error('❌ خطأ في إنشاء سجل الدخول:', [
                        'admin_id' => $admin->id,
                        'error' => $e->getMessage()
                    ]);
                }
                
                Log::info('✅ تم تسجيل دخول المشرف بنجاح:', [
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name,
                    'ip' => $request->ip()
                ]);

                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            Log::warning('❌ محاولة تسجيل دخول فاشلة:', [
                'email' => $request->email,
                'ip' => $request->ip()
            ]);

            return back()->withErrors([
                'email' => 'بيانات الدخول غير صحيحة'
            ])->withInput($request->only('email'));

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في تسجيل الدخول:', [
                'error' => $e->getMessage()
            ]);

            return back()->withErrors([
                'email' => 'حدث خطأ أثناء تسجيل الدخول'
            ])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();
            
            if ($admin) {
                try {
                    $lastLogin = $admin->loginLogs()->latest('login_at')->first();
                    if ($lastLogin) {
                        $lastLogin->recordLogout();
                        Log::info('✅ تم تحديث وقت الخروج بنجاح');
                    }
                } catch (\Exception $e) {
                    Log::error('❌ خطأ في تحديث وقت الخروج:', [
                        'error' => $e->getMessage()
                    ]);
                }

                Log::info('✅ تم تسجيل خروج المشرف بنجاح:', [
                    'admin_id' => $admin->id,
                    'admin_name' => $admin->name
                ]);
            }

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('success', 'تم تسجيل الخروج بنجاح');

        } catch (\Exception $e) {
            Log::error('🔴 خطأ في تسجيل الخروج:', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.login');
        }
    }
} 