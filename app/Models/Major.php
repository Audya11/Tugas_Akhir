<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'school_id'];

    public function school()
    {
        return $this->belongsTo(Sekolah::class, 'school_id');
    }
}
