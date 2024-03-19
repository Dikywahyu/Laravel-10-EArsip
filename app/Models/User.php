<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    //menentukan nama tabel
    protected $table = 'users';
    //menggunakan soft delete
    protected $dates = ['deleted_at'];
    //menyembunyikan id
    protected $hidden  = ['id'];
    //fill yang bisa di edit
    protected $fillable = [
        'user_id',
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
