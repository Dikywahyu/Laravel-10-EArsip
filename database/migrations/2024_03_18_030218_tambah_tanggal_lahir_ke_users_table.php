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
        Schema::table('klasifiakasi_arsips', function (Blueprint $table) {
            //
            $table->text('first_code')->nullable();
            $table->text('second_code')->nullable();
            $table->text('third_code')->nullable();
            $table->text('fourth_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klasifiakasi_arsips', function (Blueprint $table) {
            //
            $table->dropColumn('first_code');
            $table->dropColumn('second_code');
            $table->dropColumn('third_code');
            $table->dropColumn('fourth_code');
        });
    }
};
