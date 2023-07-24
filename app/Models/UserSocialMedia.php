<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media_user';

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
