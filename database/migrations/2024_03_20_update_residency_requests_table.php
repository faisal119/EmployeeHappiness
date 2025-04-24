<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('residency_requests');
        
        Schema::create('residency_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('military_id');
            $table->string('unified_number');
            $table->string('passport')->nullable();
            $table->string('id_card')->nullable();
            $table->string('current_residency')->nullable();
            $table->string('photo')->nullable();
            $table->string('employment_certificate')->nullable();
            $table->string('medical_result')->nullable();
            $table->string('service_type');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('residency_requests');
    }
}; 