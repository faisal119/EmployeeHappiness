<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            // إضافة الحقول الجديدة
            $table->string('passport')->nullable()->after('unified_number');
            $table->string('medical_result')->nullable()->after('passport');
            $table->string('id_card')->nullable()->after('medical_result');
            $table->string('salary_certificate')->nullable()->after('id_card');
            $table->string('photo')->nullable()->after('salary_certificate');
            $table->string('military_id')->nullable()->after('notes');
            $table->string('nationality')->nullable()->after('military_id');
            $table->string('pakistani_id')->nullable()->after('nationality');
            $table->string('employment_certificate')->nullable()->after('pakistani_id');
        });
    }

    public function down()
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->dropColumn([
                'passport',
                'medical_result',
                'id_card',
                'salary_certificate',
                'photo',
                'military_id',
                'nationality',
                'pakistani_id',
                'employment_certificate'
            ]);
        });
    }
}; 