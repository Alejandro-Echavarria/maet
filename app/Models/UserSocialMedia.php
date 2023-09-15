<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media_user';

    protected $fillable = [
        'user_id',
        'social_media_id',
        'url',
    ];

    public function socialMedia()
    {
        return $this->belongsTo(SocialMedia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $carbon = Carbon::parse($value)->timezone(config('app.timezone'));
        return $carbon->format('d/m/Y h:i:s A');
    }

    public function getUpdatedAtAttribute($value)
    {
        $carbon = Carbon::parse($value)->timezone(config('app.timezone'));
        return $carbon->format('d/m/Y h:i:s A');
    }

    public function scopeFilter($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query
                ->select('social_media_user.*', 'social_medias.name as social_media_name')
                ->join('social_medias', 'social_medias.id', '=', 'social_media_user.social_media_id')
                ->orWhere('social_medias.name', 'like', '%' . "$search" . '%')
                ->orWhere('social_media_user.url', 'like', '%' . $search . '%')
                ->orWhere('social_media_user.created_at', 'like', '%' . $search . '%');
        });
    }
}
