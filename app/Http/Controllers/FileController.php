<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    protected $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];

    public function show($filename)
    {
        try {
            // التحقق من تسجيل دخول المشرف
            if (!Auth::guard('admin')->check()) {
                Log::warning('محاولة غير مصرح بها للوصول إلى ملف', ['filename' => $filename]);
                abort(403, 'غير مصرح بالوصول');
            }

            // التحقق من امتداد الملف
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $this->allowedExtensions)) {
                Log::error('محاولة الوصول إلى ملف غير مسموح به', [
                    'filename' => $filename,
                    'extension' => $extension
                ]);
                abort(400, 'نوع الملف غير مسموح به');
            }

            // التحقق من وجود الملف
            $filename = basename($filename); // Get just the filename
            $possiblePaths = [
                storage_path('app/public/discount_card_files/' . $filename),
                storage_path('app/public/insurance_files/documents/' . $filename),
                storage_path('app/public/insurance_files/photos/' . $filename),
                storage_path('app/public/insurance_files/' . $filename)
            ];

            // البحث عن الملف في المجلدات المحتملة
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    return response()->file($path);
                }
            }

            // إذا لم يتم العثور على الملف، نحاول البحث عن المسار الكامل
            $fullPath = storage_path('app/public/' . $filename);
            if (file_exists($fullPath)) {
                return response()->file($fullPath);
            }

            Log::error('❌ الملف غير موجود:', [
                'filename' => $filename,
                'searched_paths' => array_merge($possiblePaths, [$fullPath])
            ]);

            abort(404, 'الملف غير موجود');
        } catch (\Exception $e) {
            Log::error('خطأ في عرض الملف:', [
                'error' => $e->getMessage(),
                'filename' => $filename
            ]);
            abort(500, 'حدث خطأ أثناء عرض الملف');
        }
    }
} 