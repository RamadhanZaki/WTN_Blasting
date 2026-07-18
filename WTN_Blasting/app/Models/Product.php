<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category', 'description', 'image', 'is_featured', 'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('images/placeholder.jpg');
        }

        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }
}
