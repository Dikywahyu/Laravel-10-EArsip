<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SirkulasiArsip extends Model
{
     use HasFactory,SoftDeletes;
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'sirkulasi_arsips_id',     
        'data_arsips_id',     
        'nama_peminjam',     
        'jabatan_peminjam',     
        'keperluan_peminjam',     
        'status_sirkulasi',     
        'sirkulasi_kembali',     
        'jumlah_peminjaman',     
    ];
}
