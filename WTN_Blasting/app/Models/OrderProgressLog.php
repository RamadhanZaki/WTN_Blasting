<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProgressLog extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'stage', 'note', 'logged_at'];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getStageLabelAttribute(): string
    {
        return Order::STAGES[$this->stage] ?? $this->stage;
    }
}
