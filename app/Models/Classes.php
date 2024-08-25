<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at'];

    public function subclass()
    {
        return $this->hasMany(Subclass::class);
    }

}
;
