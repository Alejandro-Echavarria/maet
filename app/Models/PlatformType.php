<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon'
    ];

    public function platforms()
    {
        return $this->hasMany(Platform::class);
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
                'name',
                'icon',
                'created_at',
            ], 'LIKE', "%$search%");
        });
    }
}
