<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Technology extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'slug',
        'name',
        'icon',
        'is_main',
        'color'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    // Relacion muchos a muchos inversa
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
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
                'slug',
                'name',
                'created_at'
            ], 'LIKE', "%$search%")
                ->orWhereRaw("
                    is_main =
                    (
                        CASE WHEN LOWER('$search') = 'true' THEN
                            1
                        ELSE
                            CASE WHEN LOWER('$search') = 'false' THEN
                                0
                            END
                        END
                    )
                ");
        });
    }
}
