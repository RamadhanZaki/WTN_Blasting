<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code', 'customer_name', 'phone', 'item_description', 'photo',
        'service_type', 'acc_status', 'admin_note', 'current_stage', 'queue_number',
    ];

    // Urutan tahapan sesuai alur bengkel WTN Blasting
    public const STAGES = [
        'menunggu_acc'   => 'Menunggu ACC Admin',
        'cleaning'       => 'Cleaning',
        'remove_cat'     => 'Remove Cat',
        'remove_chrome'  => 'Remove Chrome',
        'sandblasting'   => 'Sandblasting',
        'vaporblasting'  => 'Vaporblasting',
        'powder_coating' => 'Powder Coating',
        'oven'           => 'Oven',
        'finishing'      => 'Finishing',
        'done'           => 'Selesai (Done)',
    ];

    public function progressLogs()
    {
        return $this->hasMany(OrderProgressLog::class)->orderBy('logged_at');
    }

    public function getStageLabelAttribute(): string
    {
        return self::STAGES[$this->current_stage] ?? $this->current_stage;
    }

    // Persentase progres untuk progress bar
    public function getProgressPercentAttribute(): int
    {
        $keys = array_keys(self::STAGES);
        $index = array_search($this->current_stage, $keys);
        if ($index === false) return 0;
        return (int) round((($index) / (count($keys) - 1)) * 100);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    // Generate kode order unik, cth: WTN-20260719-0007
    public static function generateOrderCode(): string
    {
        $today = now()->format('Ymd');
        $countToday = self::whereDate('created_at', now()->toDateString())->count() + 1;
        return 'WTN-' . $today . '-' . str_pad($countToday, 4, '0', STR_PAD_LEFT);
    }
}
