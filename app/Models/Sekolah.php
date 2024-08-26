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

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function subclass()
    {
        return $this->hasMany(Subclass::class);
    }

    public function major()
    {
        return $this->hasMany(Major::class);
    }

    public function academicYear()
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'school_user', 'user_id', 'sekolah_id');
    }
}
