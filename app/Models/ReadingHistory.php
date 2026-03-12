<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingHistory extends Model
{
    public $timestamps = false;
    protected $table = 'reading_history';

    protected $fillable = [
        'user_id', 'comic_id', 'chapter_id',
        'page_number', 'progress_percentage',
        'ip_address', 'user_agent', 'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comic()
    {
        return $this->belongsTo(Comic::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
