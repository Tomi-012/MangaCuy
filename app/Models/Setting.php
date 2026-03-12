<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key_name', 'value', 'type', 'group_name', 'is_public'];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key_name', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function setValue(string $key, $value, string $type = 'string'): void
    {
        static::updateOrCreate(
            ['key_name' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}
