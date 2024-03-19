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
        Schema::create('sirkulasi_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('sirkulasi_arsips_id'); 
            $table->text('data_arsips_id')->nullable();  
            $table->text('nama_peminjam')->nullable();  
            $table->text('jabatan_peminjam')->nullable();  
            $table->text('keperluan_peminjam')->nullable();  
            $table->text('status_sirkulasi')->nullable();  
            $table->text('sirkulasi_kembali')->nullable();  
            $table->text('jumlah_peminjaman')->nullable();  
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirkulasi_arsips');
    }
};
