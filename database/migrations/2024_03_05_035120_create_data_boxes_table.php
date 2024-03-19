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
        Schema::create('data_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('data_boxes_id');
            $table->text('code_boxes')->nullable();
            $table->text('nama_boxes')->nullable();
            $table->text('lokasi_boxes')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_boxes');
    }
};
