<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'subtitle', 'image', 'link',
        'button_text', 'sort_order', 'is_active',
        'start_date', 'end_date'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        $colors = ['6366f1', '4f46e5', '7c3aed', '2563eb'];
        $color = $colors[$this->id % count($colors)] ?? '6366f1';
        $title = urlencode($this->title ?? 'MangaCuy');
        return "https://placehold.co/1200x500/{$color}/white?text={$title}&font=roboto";
    }
}
