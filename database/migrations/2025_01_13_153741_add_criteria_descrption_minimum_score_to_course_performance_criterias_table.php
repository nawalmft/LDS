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
        Schema::table('course_performance_criterias', function (Blueprint $table) {
            $table->text('criteria_description')->nullable()->after('criteria');
            $table->float('minimum_score')->default(3)->after('total_grade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_performance_criterias', function (Blueprint $table) {
            $table->dropColumn('criteria_description');
            $table->dropColumn('minimum_score');
        });
    }
};
