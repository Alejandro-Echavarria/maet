<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'default'
    ];

    public function Job()
    {
        return $this->morphTo(Job::class);
    }

    public function user()
    {
        return $this->morphTo(User::class);
    }
}
