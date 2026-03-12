<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterImage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'chapter_id', 'image_path', 'original_name',
        'file_size', 'width', 'height', 'sort_order', 'is_processed'
    ];

    protected $casts = [
        'is_processed' => 'boolean',
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getUrlAttribute(): string
    {
        if ($this->image_path && file_exists(storage_path('app/public/' . $this->image_path))) {
            return asset('storage/' . $this->image_path);
        }
        $page = $this->sort_order ?? 1;
        return "https://placehold.co/800x1200/1e293b/64748b?text=Page+{$page}&font=roboto";
    }
}
