<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        // حماية كل الدوال باستثناء تسجيل الدخول
        $this->middleware('auth:admin')->except(['login', 'authenticate']);
    }

    // عرض صفحة تسجيل الدخول
    public function login()
    {
        return view('admin.login'); // تأكد من وجود الملف resources/views/admin/login.blade.php
    }

    // التحقق من تسجيل الدخول
    public function authenticate(Request $request)
    {
        Log::info('محاولة تسجيل دخول', [
            'email' => $request->email,
            'ip' => $request->ip()
        ]);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            Log::info('تم تسجيل الدخول بنجاح', [
                'email' => $request->email,
                'ip' => $request->ip()
            ]);
            // إعادة توجيه للإدارة بعد تسجيل الدخول
            return redirect()->route('admin.dashboard');
        }

        Log::warning('فشل تسجيل الدخول', [
            'email' => $request->email,
            'ip' => $request->ip()
        ]);

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    // عرض الطلبات
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    

    // عرض نموذج تغيير كلمة المرور
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    // تغيير كلمة المرور
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        // تحديث كلمة المرور مباشرة
        Auth::guard('admin')->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح');
    }

    // عرض نموذج نسيان كلمة المرور
    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    // معالجة طلب إعادة تعيين كلمة المرور
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.exists' => 'هذا البريد الإلكتروني غير مسجل في النظام'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        
        // إنشاء رمز تحقق عشوائي
        $token = Str::random(60);
        
        // حفظ الرمز في قاعدة البيانات
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // إرسال رابط إعادة تعيين كلمة المرور عبر البريد الإلكتروني
        // يمكنك تنفيذ هذا الجزء لاحقاً باستخدام Laravel Mail

        return back()->with('success', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
    }

    // عرض نموذج إعادة تعيين كلمة المرور
    public function showResetPasswordForm($token)
    {
        return view('admin.reset-password', ['token' => $token]);
    }

    // معالجة إعادة تعيين كلمة المرور
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.exists' => 'هذا البريد الإلكتروني غير مسجل في النظام',
            'password.required' => 'يرجى إدخال كلمة المرور الجديدة',
            'password.min' => 'يجب أن تتكون كلمة المرور من 6 أحرف على الأقل',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withErrors(['error' => 'رمز إعادة التعيين غير صالح']);
        }

        Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('admin.login')->with('success', 'تم تغيير كلمة المرور بنجاح');
    }
}
