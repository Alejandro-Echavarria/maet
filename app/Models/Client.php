<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_type_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'description',
        'profile_photo_path',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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
            $query->whereAny([
                'first_name',
                'last_name',
                'email',
                'phone',
                'country',
                'created_at'
            ], 'LIKE', "%$search%");
        });
    }
}
