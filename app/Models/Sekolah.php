<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sekolah extends Authenticatable
{
    use HasFactory;


    protected $fillable = [
        'type',
        'nama_sekolah',
        'paket',
        'status',
        'tanggal_kadaluarsa',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat',

    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'school_user', 'user_id', 'sekolah_id');
    }
}
