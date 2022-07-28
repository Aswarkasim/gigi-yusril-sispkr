<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $guarded = [];

    function role()
    {
        return $this->hasMany(Role::class)->with('gejala');
    }
}
