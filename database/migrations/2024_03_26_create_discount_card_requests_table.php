<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('discount_card_requests');
        
        Schema::create('discount_card_requests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('employee_id');
            $table->string('card_type');
            $table->string('email');
            $table->string('emirate');
            $table->string('area');
            $table->string('father_alive');
            $table->string('mother_alive');
            $table->string('previous_card');
            $table->string('married');
            $table->integer('children_count')->nullable();
            $table->string('passport_copy');
            $table->string('emirates_id');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_card_requests');
    }
}; 