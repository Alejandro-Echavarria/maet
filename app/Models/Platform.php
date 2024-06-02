<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_type_id',
        'url',
        'platformable_id',
        'platformable_type',
    ];

    public function platformType()
    {
        return $this->belongsTo(PlatformType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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
            $query->select('platforms.*', 'platform_types.name as platform_name')
                ->join('platform_types', 'platform_types.id', '=', 'platforms.platform_type_id')
                ->whereAny([
                    'platform_types.name',
                    'platforms.url',
                    'platforms.created_at'
                ], 'LIKE', "%$search%");
        });
    }
}
