<?php

namespace App\Models;

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
        'logo_url',
        'color',
        'project_name',
        'preview',
        'body',
        'technologies',
    ];

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
    public function technologies(){

        return $this->belongsToMany(Technology::class);
    }
}
