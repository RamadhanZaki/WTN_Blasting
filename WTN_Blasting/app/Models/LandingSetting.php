<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LandingSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, $default = null)
    {
        return Cache::rememberForever("landing_setting_{$key}", function () use ($key, $default) {
            $row = self::where('key', $key)->first();
            return $row ? $row->value : $default;
        });
    }

    public static function set(string $key, $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("landing_setting_{$key}");
    }

    // Untuk field berupa list/array (mis. statistik, fitur, tahapan proses) disimpan sebagai JSON
    public static function getJson(string $key, array $default = []): array
    {
        $raw = self::get($key);
        if (!$raw) {
            return $default;
        }
        $decoded = json_decode($raw, true);
        return is_array($decoded) && count($decoded) ? $decoded : $default;
    }

    public static function setJson(string $key, array $value): void
    {
        self::set($key, json_encode(array_values($value)));
    }
}
