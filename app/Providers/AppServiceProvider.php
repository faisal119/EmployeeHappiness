<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\InsuranceRequest;
use App\Models\ResidencyRequest;
use App\Models\DiscountCardRequest;
use App\Observers\RequestStatusObserver;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        try {
            Log::info('🟢 تسجيل مراقب حالة الطلبات');
            
            InsuranceRequest::observe(RequestStatusObserver::class);
            ResidencyRequest::observe(RequestStatusObserver::class);
            DiscountCardRequest::observe(RequestStatusObserver::class);
            
            Log::info('✅ تم تسجيل مراقب حالة الطلبات بنجاح');
        } catch (\Exception $e) {
            Log::error('❌ خطأ في تسجيل مراقب حالة الطلبات:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
