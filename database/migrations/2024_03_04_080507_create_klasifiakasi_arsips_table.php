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
        Schema::create('klasifiakasi_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('klasifiakasi_arsips_id');
            $table->text('main_code')->nullable(); 
            $table->text('arsip_nama')->nullable();
            $table->text('aktiv_periode')->nullable();
            $table->text('inaktiv_periode')->nullable();
            $table->text('afeter_periode')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasifiakasi_arsips');
    }
};
