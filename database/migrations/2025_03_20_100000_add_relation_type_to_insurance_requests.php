<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationTypeToInsuranceRequests extends Migration
{
    public function up()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('insurance_requests', 'relation_type')) {
                $table->string('relation_type')->nullable()->after('marital_status');
            }
        });
    }

    public function down()
    {
        Schema::table('insurance_requests', function (Blueprint $table) {
            if (Schema::hasColumn('insurance_requests', 'relation_type')) {
                $table->dropColumn('relation_type');
            }
        });
    }
}
