<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // Relacion muchos a muchos inversa
    public function jobs(){

        return $this->belongsToMany(Job::class);
    }
}
