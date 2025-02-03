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
        Schema::table('enrollment_requests', function (Blueprint $table) {
            $table->integer('preferred_total_hours')->nullable()->after('preferred_time');
            $table->integer('preferred_daily_hours')->nullable()->after('preferred_payment_method');
            $table->integer('total_price')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollment_requests', function (Blueprint $table) {
            $table->dropColumn('preferred_total_hours');
            $table->dropColumn('preferred_daily_hours');
            $table->dropColumn('total_price');
        });
    }
};
