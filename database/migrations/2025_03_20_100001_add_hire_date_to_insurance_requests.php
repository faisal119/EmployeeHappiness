<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHireDateToInsuranceRequests extends Migration
{
    public function up()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            $table->date('hire_date')->nullable()->after('relation_type');
        });
    }

    public function down()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            $table->dropColumn('hire_date');
        });
    }
} 