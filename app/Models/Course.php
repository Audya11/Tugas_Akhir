<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'courses_title',
        'courses_description',
        'type',
        'curriculum',
        'course_code',
        'school_id',
    ];

    public function school()
    {
        return $this->belongsTo(Sekolah::class, 'school_id');
    }
}
