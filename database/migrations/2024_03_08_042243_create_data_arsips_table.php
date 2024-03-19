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
        Schema::create('data_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('data_arsips_id'); 
            $table->text('nomor_arsip')->nullable();  
            $table->text('tgl_arsip')->nullable();  
            $table->text('pencipta_arsips_id')->nullable();  
            $table->text('data_unit_penciptas_id')->nullable();  
            $table->text('klasifiakasi_arsips_id')->nullable();  
            $table->text('data_boxes_id')->nullable();  
            $table->text('jumlah_arsip')->nullable();  
            $table->text('stok_arsip')->nullable();  
            $table->text('level')->nullable();  
            $table->text('ket_arsip')->nullable();  
            $table->text('file_arsip')->nullable();  
            $table->text('penerima_arsip')->nullable();  
            $table->text('lembar_arsip')->nullable();  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_arsips');
    }
};
