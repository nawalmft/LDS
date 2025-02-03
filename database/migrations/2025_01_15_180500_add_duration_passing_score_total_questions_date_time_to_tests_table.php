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
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->integer('duration')->after('user_id');
            $table->integer('passing_score')->default(75)->after('total_grade');
            $table->integer('total_questions')->default(0)->after('test_type');
            $table->dateTime('datetime_start')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            // $table->date('start_date');
            $table->dropColumn('duration');
            $table->dropColumn('passing_score');
            $table->dropColumn('total_questions');
            $table->dropColumn('datetime_start');
        });
    }
};
