<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'alternative_title', 'synopsis',
        'cover_image', 'banner_image', 'type_id', 'status_id',
        'author', 'artist', 'released_year', 'rating',
        'total_views', 'total_bookmarks', 'is_featured',
        'is_hot', 'is_adult', 'meta_title', 'meta_description',
        'created_by', 'updated_by', 'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_hot' => 'boolean',
        'is_adult' => 'boolean',
        'published_at' => 'datetime',
        'rating' => 'decimal:1',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($comic) {
            if (empty($comic->slug)) {
                $comic->slug = Str::slug($comic->title);
            }
        });
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'comic_genre');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('chapter_number', 'desc');
    }

    public function latestChapters()
    {
        return $this->hasMany(Chapter::class)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('chapter_number', 'desc')
            ->limit(3);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', true);
    }

    public function scopeByType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    public function getFormattedViewsAttribute()
    {
        if ($this->total_views >= 1000000) {
            return round($this->total_views / 1000000, 1) . 'M';
        }
        if ($this->total_views >= 1000) {
            return round($this->total_views / 1000, 1) . 'K';
        }
        return $this->total_views;
    }

    public function getCoverUrlAttribute()
    {
        if ($this->cover_image && file_exists(storage_path('app/public/' . $this->cover_image))) {
            return asset('storage/' . $this->cover_image);
        }
        // Generate colored placeholder based on type
        $colors = ['6366f1', 'ef4444', 'f59e0b', 'ec4899', '10b981', '3b82f6', '8b5cf6', '14b8a6'];
        $color = $colors[$this->id % count($colors)] ?? '6366f1';
        $title = urlencode(Str::limit($this->title, 20, ''));
        return "https://placehold.co/300x450/{$color}/white?text={$title}&font=roboto";
    }
}
