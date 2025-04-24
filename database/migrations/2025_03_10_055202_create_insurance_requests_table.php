<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('insurance_requests', function (Blueprint $table) {
            $table->bigIncrements('id'); // معرف تلقائي
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('military_id')->nullable();
            $table->string('unified_number')->nullable();
            $table->string('phone');
            $table->string('service_type');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->string('passport')->nullable();
            $table->string('id_card')->nullable(); // ✅ تغيير الاسم من id إلى id_card
            $table->string('marriage_contract')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('employee_birth_certificate')->nullable();
            $table->string('family_book')->nullable();
            $table->string('photo')->nullable();
            $table->string('residency')->nullable();
            $table->date('hiring_date')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insurance_requests');
    }
};
