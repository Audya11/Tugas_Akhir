<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
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
        'alamat'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
