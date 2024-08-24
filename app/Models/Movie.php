<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            $movie->status = 'Hidden';
        });
    }

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

    public function getFormattedDurationAttribute()
    {
        $minutes = $this->duration; // Assume duration is in minutes
        $seconds = $minutes * 60; // Convert minutes to seconds

        $hours = floor($seconds / 3600);
        $remainingMinutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        // Format the duration
        $formatted = '';

        if ($hours > 0) {
            $formatted .= sprintf('%02dh ', $hours);
        }

        if ($remainingMinutes > 0 || $hours > 0) {
            $formatted .= sprintf('%02dmin ', $remainingMinutes);
        }

        $formatted .= sprintf('%02ds', $remainingSeconds);

        return $formatted;
    }
}
