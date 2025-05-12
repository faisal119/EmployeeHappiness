<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.users.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المشرف بنجاح');
    }

    public function edit(Admin $admin)
    {
        return view('admin.users.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        try {
            // التأكد من وجود المشرف
            if (!$admin || !$admin->exists) {
                Log::error('❌ المشرف غير موجود:', [
                    'request_data' => $request->all()
                ]);
                return redirect()->back()
                    ->with('error', 'المشرف غير موجود')
                    ->withInput();
            }

            Log::info('🟢 بداية تحديث بيانات المشرف:', [
                'admin_id' => $admin->id,
                'admin_email' => $admin->email,
                'has_password' => $request->filled('password'),
                'request_data' => $request->except(['password']) // لا نقوم بتسجيل كلمة المرور في السجلات
            ]);

            // حماية حساب it@aguard.gov.ae
            $targetIsIT = ($admin->email === 'it@aguard.gov.ae');
            $currentIsIT = (auth()->user() && auth()->user()->email === 'it@aguard.gov.ae');
            if ($targetIsIT && !$currentIsIT) {
                Log::warning('❌ محاولة تعديل حساب it@aguard.gov.ae من قبل مشرف آخر:', [
                    'admin_id' => $admin->id,
                    'admin_email' => $admin->email,
                    'by_admin_id' => auth()->id(),
                    'by_admin_email' => auth()->user() ? auth()->user()->email : 'غير معروف'
                ]);
                return redirect()->back()->with('error', 'لا يمكنك تعديل هذا الحساب. الصلاحية فقط لـ it@aguard.gov.ae')->withInput();
            }

            // التحقق من البريد الإلكتروني
            if ($request->email !== $admin->email) {
                $emailExists = Admin::where('email', $request->email)
                    ->where('id', '!=', $admin->id)
                    ->exists();
                
                if ($emailExists) {
                    Log::warning('❌ البريد الإلكتروني مستخدم من قبل:', [
                        'email' => $request->email,
                        'admin_id' => $admin->id,
                        'current_email' => $admin->email
                    ]);
                    return redirect()->back()
                        ->with('error', 'البريد الإلكتروني مستخدم من قبل مشرف آخر')
                        ->withInput();
                }
            }

            // التحقق من البيانات
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|string|min:6',
            ]);

            if ($validator->fails()) {
                Log::warning('❌ فشل التحقق من البيانات:', [
                    'admin_id' => $admin->id,
                    'errors' => $validator->errors()->toArray()
                ]);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {
                $oldEmail = $admin->email;
                $admin->name = $request->name;
                $admin->email = $request->email;
                $passwordChanged = false;
                if ($request->filled('password')) {
                    Log::info('🔄 تم تغيير كلمة المرور للمشرف:', [
                        'admin_id' => $admin->id,
                        'admin_email' => $admin->email,
                        'changed_by' => auth()->user() ? auth()->user()->email : 'غير معروف'
                    ]);
                    $admin->password = Hash::make($request->password);
                    $passwordChanged = true;
                }

                $admin->save();

                Log::info('✅ تم تحديث بيانات المشرف بنجاح:', [
                    'admin_id' => $admin->id,
                    'name' => $admin->name,
                    'old_email' => $oldEmail,
                    'new_email' => $admin->email,
                    'password_updated' => $passwordChanged
                ]);

                DB::commit();

                $successMsg = 'تم تحديث بيانات المشرف بنجاح';
                if ($passwordChanged) {
                    $successMsg .= ' وتم تغيير كلمة المرور.';
                }
                return redirect()->route('admin.users.index')
                    ->with('success', $successMsg);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('❌ خطأ في تحديث بيانات المشرف:', [
                    'error' => $e->getMessage(),
                    'admin_id' => $admin->id,
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('❌ خطأ في تحديث المشرف:', [
                'error' => $e->getMessage(),
                'admin_id' => isset($admin) ? $admin->id : null,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث بيانات المشرف')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        Log::info('محاولة حذف المشرف:', ['admin_id' => $id]);
        
        try {
            DB::beginTransaction();
            
            $admin = Admin::findOrFail($id);
            
            // التحقق من أن المستخدم لا يحاول حذف نفسه
            if ($admin->id === auth()->id()) {
                Log::warning('محاولة حذف النفس:', ['admin_id' => $id]);
                return redirect()->back()->with('error', 'لا يمكنك حذف حسابك الخاص');
            }

            // التحقق من عدد المشرفين
            if (Admin::count() <= 1) {
                Log::warning('محاولة حذف المشرف الأخير');
                return redirect()->back()->with('error', 'لا يمكن حذف المشرف الأخير');
            }

            // حذف المشرف
            $admin->delete();
            
            DB::commit();
            
            Log::info('تم حذف المشرف بنجاح:', ['admin_id' => $id]);
            
            return redirect()->route('admin.users.index')->with('success', 'تم حذف المشرف بنجاح');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('خطأ في حذف المشرف:', [
                'error' => $e->getMessage(),
                'admin_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف المشرف');
        }
    }
} 