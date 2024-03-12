<?php

namespace App\Models;

use App\Models\Image;
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

    public function scopeFilter($query, $filter)
    {
        $query->when($filter ?? null, function ($query, $search) {
            $query
                ->select('jobs.*')
                // ->join('social_medias', 'social_medias.id', '=', 'jobs.social_media_id')
                ->orWhere('jobs.title', 'like', '%' . "$search" . '%')
                ->orWhere('jobs.created_at', 'like', '%' . $search . '%');
        });
    }
}
