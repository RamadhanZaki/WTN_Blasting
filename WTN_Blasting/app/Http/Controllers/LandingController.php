<?php

namespace App\Http\Controllers;

use App\Models\LandingSetting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order')->orderByDesc('is_featured')->take(8)->get();
        $testimonials = Testimonial::where('is_published', true)->latest()->take(6)->get();

        // Antrean sekarang: order yang sudah di-ACC tapi belum done, urut queue_number
        $currentQueue = Order::where('acc_status', 'approved')
            ->where('current_stage', '!=', 'done')
            ->orderBy('queue_number')
            ->take(10)
            ->get();

        $settings = [
            'hero_badge'    => LandingSetting::get('hero_badge', 'Powder Coating & Vaporblasting Specialist'),
            'hero_title'    => LandingSetting::get('hero_title', 'WTN BLASTING'),
            'hero_subtitle' => LandingSetting::get('hero_subtitle', 'Powder Coating & Vaporblasting Profesional'),
            'hero_bg_image' => LandingSetting::get('hero_bg_image', 'images/hero-lokasi-kios.jpg'),

            'rating_value'  => LandingSetting::get('rating_value', '4.9'),
            'rating_count'  => LandingSetting::get('rating_count', '200+'),

            'about_text'    => LandingSetting::get('about_text', ''),
            'address'       => LandingSetting::get('address', ''),
            'phone'         => LandingSetting::get('phone', ''),
            'maps_embed'    => LandingSetting::get('maps_embed', ''),

            'stats' => LandingSetting::getJson('stats', [
                ['value' => '1.200+', 'label' => 'Item Dikerjakan'],
                ['value' => '5+', 'label' => 'Tahun Pengalaman'],
                ['value' => '4.9★', 'label' => 'Rating Pelanggan'],
                ['value' => '3-5 Hari', 'label' => 'Estimasi Pengerjaan'],
            ]),

            'why_title' => LandingSetting::get('why_title', 'Dikerjakan Serius, Hasil Tahan Lama'),
            'features'  => LandingSetting::getJson('features', [
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Estimasi pengerjaan 3–5 hari kerja tergantung antrean & jenis layanan.'],
                ['icon' => '🛡️', 'title' => 'Kualitas Terjamin', 'desc' => 'Bahan coating & standar sandblasting terjaga untuk hasil rapi & awet.'],
                ['icon' => '📱', 'title' => 'Tracking Transparan', 'desc' => 'Pantau progres order kamu secara real-time lewat kode order.'],
                ['icon' => '👨‍🔧', 'title' => 'Tim Berpengalaman', 'desc' => 'Ditangani teknisi berpengalaman di bidang blasting & coating.'],
            ]),

            'proses' => LandingSetting::getJson('proses', [
                ['title' => 'Order & ACC', 'desc' => 'Kirim data & foto barang, menunggu ACC admin.'],
                ['title' => 'Cleaning & Remove', 'desc' => 'Pembersihan permukaan dari cat/krom lama.'],
                ['title' => 'Blasting', 'desc' => 'Sandblasting / vaporblasting sesuai kebutuhan.'],
                ['title' => 'Coating & Oven', 'desc' => 'Powder coating lalu proses oven pengeringan.'],
                ['title' => 'Finishing & Selesai', 'desc' => 'Quality check, finishing, barang siap diambil.'],
            ]),

            'cta_title' => LandingSetting::get('cta_title', 'Siap Bikin Barangmu Terlihat Baru Lagi?'),
            'cta_text'  => LandingSetting::get('cta_text', 'Kirim order sekarang, tim kami akan segera memproses dan menghubungimu untuk konfirmasi.'),
        ];

        return view('landing.index', compact('products', 'testimonials', 'currentQueue', 'settings'));
    }
}
