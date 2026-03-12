<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'icon', 'color', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function comics()
    {
        return $this->hasMany(Comic::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
