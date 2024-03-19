<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KlasifiakasiArsip extends Model
{
    use HasFactory,SoftDeletes;
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'klasifiakasi_arsips_id', 
        'main_code',  
        'arsip_nama', 
        'aktiv_periode', 
        'inaktiv_periode', 
        'afeter_periode',   
        'first_code',   
        'second_code',   
        'third_code',   
        'fourth_code',   
    ];
}
