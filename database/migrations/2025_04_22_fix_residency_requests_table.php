<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // إعادة إنشاء الجدول بالهيكل الصحيح
        Schema::dropIfExists('residency_requests');
        
        Schema::create('residency_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('military_id');
            $table->string('unified_number');
            $table->string('nationality')->nullable();
            $table->string('service_type');
            $table->string('passport')->nullable();
            $table->string('medical_result')->nullable();
            $table->string('id_card')->nullable();
            $table->string('salary_certificate')->nullable();
            $table->string('photo')->nullable();
            $table->string('employment_certificate')->nullable();
            $table->string('current_residency')->nullable();
            $table->string('sponsorship_transfer_certificate')->nullable();
            $table->string('entry_permit')->nullable();
            $table->string('acquaintance_document')->nullable();
            $table->string('noc_letter')->nullable();
            $table->string('pakistani_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('residency_requests');
    }
}; 