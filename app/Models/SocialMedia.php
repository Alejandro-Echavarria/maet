<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = [
        'name',
        'icon'
    ];

    public function socialMediaUsers()
    {
        return $this->hasMany(SocialMediaUser::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $carbon = Carbon::parse($value)->timezone(config('app.timezone'));
        return $carbon->format('Y-m-d h:i:s A');
    }

    public function getUpdatedAtAttribute($value)
    {
        $carbon = Carbon::parse($value)->timezone(config('app.timezone'));
        return $carbon->format('Y-m-d h:i:s A');
    }
}
