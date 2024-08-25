<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'sekolah_id',
        'nama',
        'nip',
        'alamat',
        'jenis_kelamin',
        'agama',
        'kelas',
        'no_telp',
    ];

    public function school()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
