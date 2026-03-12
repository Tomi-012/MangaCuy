<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Genre extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'description', 'color', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($genre) {
            if (empty($genre->slug)) {
                $genre->slug = Str::slug($genre->name);
            }
        });
    }

    public function comics()
    {
        return $this->belongsToMany(Comic::class, 'comic_genre');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
