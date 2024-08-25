<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'sekolah_id',
        'nama',
        'nis',
        'alamat',
        'jenis_kelamin',
        'agama',
        'kelas',
        'no_telp',
        'average_score'
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
