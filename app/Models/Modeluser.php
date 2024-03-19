<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modeluser extends Model
{
    use HasFactory, SoftDeletes;

    //menentukan nama tabel
    protected $table = 'users';
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'user_id',
        'user_name',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'phone',
        'status',
        'level',
        'file_foto',
        'file_profile',
        'password',
        'apassword',
        'remember_token',
    ];
}
