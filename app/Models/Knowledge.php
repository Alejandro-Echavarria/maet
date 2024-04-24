<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
        'is_main',
    ];

    protected $casts = [
        'is_main'    => 'boolean',
        'created_at' => "date:d/m/Y",
        'updated_at' => "date:d/m/Y",
    ];

    // Relación uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
