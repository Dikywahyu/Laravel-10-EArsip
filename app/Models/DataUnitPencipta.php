<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataUnitPencipta extends Model
{
    use HasFactory,SoftDeletes;
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'pencipta_arsips_id', 
        'data_unit_penciptas_id',  
        'nama_data_unit_penciptas',  
    ];
}
