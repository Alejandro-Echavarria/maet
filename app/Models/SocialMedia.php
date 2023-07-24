<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    public function socialMediaUsers()
    {
        return $this->hasMany(SocialMediaUser::class);
    }
}
