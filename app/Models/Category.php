<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Relación uno a muchos inversa
    public function jobs()
    {
        return $this->hasMany(User::class);
    }
}
