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
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->string('nationality')->nullable()->after('unified_number');
            $table->string('pakistani_id')->nullable()->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residency_requests', function (Blueprint $table) {
            $table->dropColumn('nationality');
            $table->dropColumn('pakistani_id');
        });
    }
}; 