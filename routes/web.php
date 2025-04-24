<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Admin\StatisticsController as AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;

// 🔹 الصفحة الرئيسية
Route::view('/', 'home');

// 🔹 الخدمات
Route::view('/insurance', 'insurance-service');
Route::view('/discount-card', 'discount-card');
Route::view('/residency', 'residency-service');

// 🔹 صفحات تقديم طلب التأمين
Route::get('/insurance/request/add-new', function () {
    return view('insurance.add-new');
})->name('insurance.add-new');

Route::get('/insurance/request/add-spouse', function () {
    return view('insurance.add-spouse');
})->name('insurance.add-spouse');

Route::get('/insurance/request/add-children', function () {
    return view('insurance.add-children');
})->name('insurance.add-children');

Route::get('/insurance/request/add-parents', function () {
    return view('insurance.add-parents');
})->name('insurance.add-parents');

Route::get('/insurance/request/certificate', function () {
    return view('insurance.certificate');
})->name('insurance.certificate');

Route::get('/insurance/request/update', function () {
    return view('insurance.update');
})->name('insurance.update');

// 🔹 إرسال طلب التأمين الصحي
Route::post('/insurance/submit', [RequestController::class, 'storeInsuranceRequest'])->name('insurance.store');
Route::post('/insurance/update-request', [RequestController::class, 'updateInsuranceRequest'])->name('insurance.update-request');

// 🔹 عرض صفحة طلب التأمين الصحي
Route::get('/insurance/request', function (Request $request) {
    $descriptions = [
        'new' => 'طلب تأمين جديد',
        'add-family' => 'إضافة أحد أفراد العائلة إلى التأمين الصحي',
        'update' => 'تحديث بيانات التأمين الصحي',
        'certificate' => 'طلب شهادة تأمين صحي',
    ];

    $type = $request->query('type', 'new'); // افتراضيًا يكون `new`

    if ($type === 'certificate') {
        return view('insurance.certificate');
    }

    $requestTypeDesc = $descriptions[$type] ?? 'طلب تأمين صحي';

    return view('insurance-request', compact('requestTypeDesc', 'type')); // ✅ تم تمرير نوع الطلب
});


Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// 🔹 مسارات تسجيل دخول المشرف
Route::get('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');

// مسارات إعادة تعيين كلمة المرور للمشرف
Route::middleware(['web'])->group(function () {
    Route::get('/admin/password/reset', [AdminController::class, 'showForgotPasswordForm'])->name('admin.password.request');
    Route::post('/admin/password/email', [AdminController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('/admin/password/reset/{token}', [AdminController::class, 'showResetPasswordForm'])->name('admin.password.reset');
    Route::post('/admin/password/reset', [AdminController::class, 'resetPassword'])->name('admin.password.update');
});

// 🔹 حماية جميع صفحات الأدمن باستخدام Middleware
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // 🔹 لوحة التحكم
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // تحديث تعريف مسارات المشرفين
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{admin}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{admin}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{admin}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');

    // 🔹 إدارة الطلبات
    Route::get('/requests', [RequestController::class, 'index'])->name('requests');
    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');
    Route::match(['put', 'post'], '/requests/{id}/status', [RequestController::class, 'updateStatus'])->name('requests.update-status');
    Route::delete('/request/{id}', [RequestController::class, 'destroy'])->name('request.delete');
    
    // 🔹 عرض الملفات المرفقة
    Route::get('files/{filename}', [FileController::class, 'show'])->name('files.show');

    // 🔹 تغيير كلمة المرور
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword');
    
    // 🔹 إدارة الاقتراحات
    Route::get('/suggestions', [SuggestionController::class, 'adminIndex'])->name('suggestions.index');
    Route::get('/suggestions/{suggestion}', [SuggestionController::class, 'show'])->name('suggestions.show');
    Route::put('/suggestions/{suggestion}', [SuggestionController::class, 'update'])->name('suggestions.update');
    Route::delete('/suggestions/{suggestion}', [SuggestionController::class, 'destroy'])->name('suggestions.destroy');
});

// 🔹 الطلبات العامة
Route::view('/request', 'request');
Route::view('/confirmation', 'confirmation');

// مسارات خدمات الإقامة
Route::prefix('residency')->group(function () {
    Route::get('/renew-residency', function () {
        return view('residency.renew-residency');
    })->name('residency.renew');

    Route::get('/sponsorship-transfer', function () {
        return view('residency.sponsorship-transfer');
    })->name('residency.sponsorship-transfer');

    Route::get('/visa-request', function () {
        return view('residency.visa-request');
    })->name('residency.visa');

    Route::get('/residence-id', function () {
        return view('residency.residence-id');
    })->name('residency.residence-id');

    Route::post('/submit', [RequestController::class, 'storeResidencyRequest'])->name('residency.store');
});

// مسارات خدمات التأشيرات
Route::prefix('visa')->group(function () {
    Route::get('/new-visa', function () {
        return view('visa.new-visa');
    })->name('visa.new');

    Route::get('/visa-renewal', function () {
        return view('visa.visa-renewal');
    })->name('visa.renewal');

    Route::get('/visa-cancellation', function () {
        return view('visa.visa-cancellation');
    })->name('visa.cancellation');

    Route::post('/submit', [RequestController::class, 'storeVisaRequest'])->name('visa.store');
});

// مسارات خدمات التأمين
Route::prefix('insurance')->group(function () {
    Route::get('/new-insurance', function () {
        return view('insurance.new-insurance');
    })->name('insurance.new');

    Route::get('/insurance-renewal', function () {
        return view('insurance.insurance-renewal');
    })->name('insurance.renewal');

    Route::get('/insurance-cancellation', function () {
        return view('insurance.insurance-cancellation');
    })->name('insurance.cancellation');

    Route::post('/submit', [RequestController::class, 'storeInsuranceRequest'])->name('insurance.store');
});

// مسارات خدمات التأشيرات السياحية
Route::prefix('tourist-visa')->group(function () {
    Route::get('/new-tourist-visa', function () {
        return view('tourist-visa.new-tourist-visa');
    })->name('tourist-visa.new');

    Route::get('/tourist-visa-renewal', function () {
        return view('tourist-visa.tourist-visa-renewal');
    })->name('tourist-visa.renewal');

    Route::get('/tourist-visa-cancellation', function () {
        return view('tourist-visa.tourist-visa-cancellation');
    })->name('tourist-visa.cancellation');

    Route::post('/submit', [RequestController::class, 'storeTouristVisaRequest'])->name('tourist-visa.store');
});

// 🔹 طلب بطاقة الخصم
Route::get('/discount-card', function () {
    return view('discount-card');
})->name('discount-card.show');

Route::post('/discount-card/store', [RequestController::class, 'storeDiscountCardRequest'])->name('discount-card.store');

// مسارات الاقتراحات للمستخدمين
Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
