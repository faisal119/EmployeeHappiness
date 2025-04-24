<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('residency_requests')) {
            Schema::create('residency_requests', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->string('military_number');
                $table->string('unified_number');
                $table->string('passport_copy')->nullable();
                $table->string('emirates_id')->nullable();
                $table->string('current_residency')->nullable();
                $table->string('personal_photo')->nullable();
                $table->string('acquaintance_document')->nullable();
                $table->string('noc_letter')->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residency_requests');
    }
};
