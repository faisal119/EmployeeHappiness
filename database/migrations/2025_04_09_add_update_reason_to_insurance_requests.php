<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('insurance_requests', 'update_reason')) {
                $table->text('update_reason')->nullable()->after('service_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (Schema::hasColumn('insurance_requests', 'update_reason')) {
                $table->dropColumn('update_reason');
            }
        });
    }
};
