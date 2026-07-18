<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    // Field teks biasa (bukan JSON array)
    protected array $textKeys = [
        'hero_badge', 'hero_title', 'hero_subtitle',
        'rating_value', 'rating_count',
        'about_text', 'address', 'phone', 'maps_embed',
        'why_title', 'cta_title', 'cta_text',
    ];

    protected function defaults(): array
    {
        return [
            'stats' => [
                ['value' => '1.200+', 'label' => 'Item Dikerjakan'],
                ['value' => '5+', 'label' => 'Tahun Pengalaman'],
                ['value' => '4.9★', 'label' => 'Rating Pelanggan'],
                ['value' => '3-5 Hari', 'label' => 'Estimasi Pengerjaan'],
            ],
            'features' => [
                ['icon' => '⚡', 'title' => 'Proses Cepat', 'desc' => 'Estimasi pengerjaan 3–5 hari kerja tergantung antrean & jenis layanan.'],
                ['icon' => '🛡️', 'title' => 'Kualitas Terjamin', 'desc' => 'Bahan coating & standar sandblasting terjaga untuk hasil rapi & awet.'],
                ['icon' => '📱', 'title' => 'Tracking Transparan', 'desc' => 'Pantau progres order kamu secara real-time lewat kode order.'],
                ['icon' => '👨‍🔧', 'title' => 'Tim Berpengalaman', 'desc' => 'Ditangani teknisi berpengalaman di bidang blasting & coating.'],
            ],
            'proses' => [
                ['title' => 'Order & ACC', 'desc' => 'Kirim data & foto barang, menunggu ACC admin.'],
                ['title' => 'Cleaning & Remove', 'desc' => 'Pembersihan permukaan dari cat/krom lama.'],
                ['title' => 'Blasting', 'desc' => 'Sandblasting / vaporblasting sesuai kebutuhan.'],
                ['title' => 'Coating & Oven', 'desc' => 'Powder coating lalu proses oven pengeringan.'],
                ['title' => 'Finishing & Selesai', 'desc' => 'Quality check, finishing, barang siap diambil.'],
            ],
        ];
    }

    public function edit()
    {
        $settings = [];
        foreach ($this->textKeys as $key) {
            $settings[$key] = LandingSetting::get($key, '');
        }
        $settings['hero_bg_image'] = LandingSetting::get('hero_bg_image', '');

        $defaults = $this->defaults();
        $settings['stats']    = LandingSetting::getJson('stats', $defaults['stats']);
        $settings['features'] = LandingSetting::getJson('features', $defaults['features']);
        $settings['proses']   = LandingSetting::getJson('proses', $defaults['proses']);

        return view('admin.landing.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_badge'    => 'nullable|string|max:150',
            'hero_title'    => 'nullable|string|max:150',
            'hero_subtitle' => 'nullable|string|max:255',
            'hero_bg_image' => 'nullable|image|max:8192',

            'rating_value'  => 'nullable|string|max:10',
            'rating_count'  => 'nullable|string|max:20',

            'about_text'    => 'nullable|string|max:3000',
            'address'       => 'nullable|string|max:500',
            'phone'         => 'nullable|string|max:30',
            'maps_embed'    => 'nullable|string|max:3000',

            'why_title'     => 'nullable|string|max:150',
            'cta_title'     => 'nullable|string|max:150',
            'cta_text'      => 'nullable|string|max:500',

            'stats'              => 'nullable|array',
            'stats.*.value'      => 'nullable|string|max:30',
            'stats.*.label'      => 'nullable|string|max:60',

            'features'           => 'nullable|array',
            'features.*.icon'    => 'nullable|string|max:10',
            'features.*.title'   => 'nullable|string|max:60',
            'features.*.desc'    => 'nullable|string|max:255',

            'proses'             => 'nullable|array',
            'proses.*.title'     => 'nullable|string|max:60',
            'proses.*.desc'      => 'nullable|string|max:255',
        ]);

        // Foto background hero
        if ($request->hasFile('hero_bg_image')) {
            $path = $request->file('hero_bg_image')->store('landing', 'public');
            LandingSetting::set('hero_bg_image', 'storage/' . $path);
        }

        // Field teks biasa
        foreach ($this->textKeys as $key) {
            LandingSetting::set($key, $data[$key] ?? '');
        }

        // Field berupa daftar (JSON): buang baris yang kosong semua, lalu simpan
        LandingSetting::setJson('stats', $this->cleanRows($data['stats'] ?? [], ['value', 'label']));
        LandingSetting::setJson('features', $this->cleanRows($data['features'] ?? [], ['icon', 'title', 'desc']));
        LandingSetting::setJson('proses', $this->cleanRows($data['proses'] ?? [], ['title', 'desc']));

        return back()->with('success', 'Landing page berhasil diperbarui.');
    }

    // Hilangkan baris yang seluruh kolomnya kosong (mis. admin sengaja mengosongkan salah satu slot fitur)
    private function cleanRows(array $rows, array $fields): array
    {
        return array_values(array_filter($rows, function ($row) use ($fields) {
            foreach ($fields as $f) {
                if (!empty(trim($row[$f] ?? ''))) {
                    return true;
                }
            }
            return false;
        }));
    }
}
