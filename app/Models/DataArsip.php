<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataArsip extends Model
{
    use HasFactory,SoftDeletes;
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'data_arsips_id',     
        'nomor_arsip',     
        'tgl_arsip',     
        'pencipta_arsips_id',     
        'data_unit_penciptas_id',     
        'klasifiakasi_arsips_id',     
        'data_boxes_id',     
        'jumlah_arsip',     
        'level',     
        'ket_arsip',     
        'file_arsip',     
        'stok_arsip',     
        'penerima_arsip',     
        'lembar_arsip',     
    ];
}
