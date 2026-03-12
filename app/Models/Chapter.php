<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id', 'chapter_number', 'title', 'slug',
        'content', 'is_premium', 'price', 'views', 'downloads',
        'published_at', 'created_by'
    ];

    protected $casts = [
        'chapter_number' => 'decimal:2',
        'is_premium' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($chapter) {
            if (empty($chapter->slug)) {
                $chapter->slug = 'chapter-' . $chapter->chapter_number;
            }
        });
    }

    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }

    public function images()
    {
        return $this->hasMany(ChapterImage::class)->orderBy('sort_order');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getChapterTitleAttribute(): string
    {
        return $this->title ?? "Chapter {$this->chapter_number}";
    }

    public function getFormattedViewsAttribute()
    {
        if ($this->views >= 1000000) return round($this->views / 1000000, 1) . 'M';
        if ($this->views >= 1000) return round($this->views / 1000, 1) . 'K';
        return $this->views;
    }
}
