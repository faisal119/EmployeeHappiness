<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up()
    {
        try {
            Log::info('🟢 بدء تنفيذ هجرة جدول request_statistics');
            
            // حذف الجدول إذا كان موجوداً
            if (Schema::hasTable('request_statistics')) {
                Schema::dropIfExists('request_statistics');
                Log::info('✅ تم حذف الجدول القديم بنجاح');
            }
            
            // إنشاء الجدول من جديد
            Schema::create('request_statistics', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id');
                $table->unsignedBigInteger('request_id');
                $table->string('request_type'); // نوع الطلب (insurance, discount-card, residency)
                $table->string('action_type'); // حالة الطلب (pending, approved, rejected)
                $table->timestamps();

                // إضافة المفتاح الخارجي
                $table->foreign('admin_id')
                      ->references('id')
                      ->on('admins')
                      ->onDelete('cascade');

                // إضافة فهرس للبحث السريع
                $table->index(['request_type', 'action_type']);
                $table->index(['admin_id', 'request_id']);
            });

            Log::info('✅ تم إنشاء الجدول بنجاح');

            // التحقق من وجود الجدول وأعمدته
            if (Schema::hasTable('request_statistics')) {
                $columns = Schema::getColumnListing('request_statistics');
                Log::info('✅ تم التحقق من وجود الجدول وأعمدته:', [
                    'columns' => $columns
                ]);
            } else {
                throw new \Exception('فشل في إنشاء الجدول');
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::statement('GRANT ALL PRIVILEGES ON employee_happiness.* TO "root"@"localhost";');
            DB::statement('FLUSH PRIVILEGES;');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            Log::info('✅ تم إكمال الهجرة بنجاح');

        } catch (\Exception $e) {
            Log::error('❌ خطأ أثناء تنفيذ الهجرة:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function down()
    {
        Schema::dropIfExists('request_statistics');
    }
}; 