<?php

namespace Database\Seeders;

use App\Models\LandingSetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

/**
 * Dummy/demo content so the landing page has enough data to preview
 * the new design. Safe to run repeatedly (uses updateOrCreate).
 *
 * Run with: php artisan db:seed --class=LandingDemoSeeder
 */
class LandingDemoSeeder extends Seeder
{
    public function run(): void
    {
        LandingSetting::set('hero_title', 'WTN BLASTING');
        LandingSetting::set('hero_subtitle', 'Powder Coating & Vaporblasting Profesional — Hasil Rapi, Tahan Lama');
        LandingSetting::set('hero_bg_image', 'images/hero-lokasi-kios.jpg');
        LandingSetting::set('about_text', 'WTN Blasting melayani jasa powder coating dan vaporblasting untuk velg, sparepart motor/mobil, dan berbagai komponen metal lainnya. Dikerjakan oleh tim berpengalaman dengan standar hasil yang rapi dan tahan lama.');
        LandingSetting::set('address', 'Jl. Raya Blasting No. 21, Depok, Yogyakarta');
        LandingSetting::set('phone', '0812-3456-7890');
        LandingSetting::set('maps_embed', '');

        // ---------- PRODUCTS ----------
        $products = [
            ['title' => 'Velg Racing 17" - Gloss Black', 'category' => 'Velg Mobil', 'seed' => 'velg1', 'featured' => true],
            ['title' => 'Velg Motor Sport - Candy Red', 'category' => 'Velg Motor', 'seed' => 'velg2', 'featured' => true],
            ['title' => 'Blok Mesin - Vaporblasting Clean', 'category' => 'Sparepart Mesin', 'seed' => 'mesin1', 'featured' => false],
            ['title' => 'Knalpot Custom - Titanium Coat', 'category' => 'Sparepart Motor', 'seed' => 'knalpot1', 'featured' => true],
            ['title' => 'Velg Jeep 15" - Matte Bronze', 'category' => 'Velg Mobil', 'seed' => 'velg3', 'featured' => false],
            ['title' => 'Swing Arm - Powder Orange', 'category' => 'Sparepart Motor', 'seed' => 'arm1', 'featured' => false],
            ['title' => 'Head Cylinder - Vaporblasting', 'category' => 'Sparepart Mesin', 'seed' => 'mesin2', 'featured' => false],
            ['title' => 'Velg Sepeda Fixie - Chrome', 'category' => 'Velg Sepeda', 'seed' => 'velg4', 'featured' => false],
        ];

        foreach ($products as $i => $p) {
            Product::updateOrCreate(
                ['title' => $p['title']],
                [
                    'category' => $p['category'],
                    'description' => 'Hasil pengerjaan ' . $p['category'] . ' oleh tim WTN Blasting.',
                    'image' => "https://picsum.photos/seed/{$p['seed']}/600/600",
                    'is_featured' => $p['featured'],
                    'order' => $i + 1,
                ]
            );
        }

        // ---------- TESTIMONIALS ----------
        $testimonials = [
            ['name' => 'Budi Santoso', 'rating' => 5, 'avatar' => 12, 'content' => 'Hasil powder coating velg saya rapi banget, warnanya presisi sesuai request. Recommended!'],
            ['name' => 'Siti Rahma', 'rating' => 5, 'avatar' => 47, 'content' => 'Prosesnya cepat dan bisa dipantau lewat tracking, jadi ga was-was. Hasilnya juga memuaskan.'],
            ['name' => 'Andi Wijaya', 'rating' => 4, 'avatar' => 33, 'content' => 'Vaporblasting blok mesin motor saya jadi bersih kayak baru. Worth it harganya.'],
            ['name' => 'Rina Kusuma', 'rating' => 5, 'avatar' => 45, 'content' => 'Pelayanan ramah, admin fast response, hasil coating knalpot custom saya keren banget.'],
            ['name' => 'Dedi Prasetyo', 'rating' => 5, 'avatar' => 15, 'content' => 'Sudah 3 kali order di sini selalu puas, kualitas konsisten dan harga bersaing.'],
            ['name' => 'Lina Marlina', 'rating' => 4, 'avatar' => 29, 'content' => 'Velg mobil saya jadi kinclong lagi, warnanya sesuai sama contoh yang saya kasih.'],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['customer_name' => $t['name']],
                [
                    'content' => $t['content'],
                    'image' => "https://i.pravatar.cc/150?img={$t['avatar']}",
                    'rating' => $t['rating'],
                    'is_published' => true,
                ]
            );
        }

        // ---------- ORDERS (current queue) ----------
        $stages = ['cleaning', 'remove_cat', 'sandblasting', 'vaporblasting', 'powder_coating', 'oven', 'finishing'];
        $names = ['Rizky Ramadhan', 'Fajar Nugroho', 'Wulan Sari', 'Agus Setiawan', 'Putri Ayu', 'Bayu Aji', 'Nadia Putri', 'Yoga Pratama'];

        foreach ($names as $i => $name) {
            $code = 'WTN-20260715-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            Order::updateOrCreate(
                ['order_code' => $code],
                [
                    'customer_name' => $name,
                    'phone' => '0812' . rand(10000000, 99999999),
                    'item_description' => 'Order demo #' . ($i + 1),
                    'photo' => null,
                    'service_type' => ['powder_coating', 'vaporblasting', 'both'][array_rand([0, 1, 2])],
                    'acc_status' => 'approved',
                    'admin_note' => null,
                    'current_stage' => $stages[$i % count($stages)],
                    'queue_number' => $i + 1,
                ]
            );
        }
    }
}
