<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('insurance_requests', 'child_name')) {
                $table->string('child_name')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (Schema::hasColumn('insurance_requests', 'child_name')) {
                $table->dropColumn('child_name');
            }
        });
    }
};
