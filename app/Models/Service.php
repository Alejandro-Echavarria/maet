<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'price',
        'color'
    ];

    // Relación uno a muchos inversa
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
            $query->whereAny([
                'name',
                'icon',
                'description',
                'color',
                'created_at',
                'updated_at'
            ], 'LIKE', "%$search%");
        });
    }
}
