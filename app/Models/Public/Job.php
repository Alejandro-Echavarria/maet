<?php

namespace App\Models\Public;

use App\Models\Category;
use App\Models\Client;
use App\Models\Image;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

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
}
