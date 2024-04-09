<?php

namespace App\Models;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'category_id',
        'client_id',
        'title',
        'slug',
        'logo_url',
        'color',
        'project_name',
        'link',
        'preview',
        'body',
        'technologies',
        'alt_banner_image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relación uno a muchos
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación muchos a muchos
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
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

    public function scopeFilter($query, $filter, $model = null)
    {
        if ($model === null) {
            $query->when($filter ?? null, function ($query, $search) {
                $query
                    ->select('jobs.*')
                    ->orWhere('jobs.title', 'like', '%' . "$search" . '%')
                    ->orWhere('jobs.created_at', 'like', '%' . $search . '%');
            });
        } else {
            if ($model === 'category') {
                $this->scopeFilterByCategory($query, $filter);
            } else if ($model === 'technology') {
                $this->scopeFilterByTechnology($query, $filter);
            }
        }
    }

    public function scopeFilterByCategory($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query
                ->select('jobs.*')
                ->join('categories', 'categories.id', '=', 'jobs.category_id')
                ->orWhere('categories.slug', 'like', '%' . "$search" . '%')
                ->groupBy('jobs.id');
        });
    }

    public function scopeFilterByTechnology($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query
                ->select('jobs.*')
                ->join('job_technology', 'job_technology.job_id', '=', 'jobs.id')
                ->join('technologies', 'technologies.id', '=', 'job_technology.technology_id')
                ->orWhere('technologies.slug', 'like', '%' . "$search" . '%')
                ->groupBy('jobs.id');
        });
    }
}
