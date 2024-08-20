<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'release_year', 'duration', 'quality', 
        'language', 'cover_image', 'video_url', 'type'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }
}
