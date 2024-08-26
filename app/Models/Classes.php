<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'school_id'];

    public function subclass()
    {
        return $this->hasMany(Subclass::class);
    }

    public function school()
    {
        return $this->belongsTo(Sekolah::class, 'school_id');
    }

}
;