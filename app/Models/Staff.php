<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'role',
        'no_telp',
        'photo',
        'jenis_kelamin',
    ];
}
