@extends('layouts.admin')
@section('title', 'Edit Landing Page - Admin WTN BLASTING')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <div>
        <h1 class="text-2xl font-bold">Edit Landing Page</h1>
        <p class="text-sm text-neutral-500 mt-1">Semua perubahan di sini langsung tampil di halaman utama website.</p>
    </div>
    <a href="{{ route('landing.index') }}" target="_blank" class="text-sm text-orange-600 hover:underline">Lihat Website &rarr;</a>
</div>

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm mb-6">
        <p class="font-medium mb-1">Periksa kembali isian berikut:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.landing.update') }}" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
    @csrf

    {{-- ============ HERO ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Hero (Bagian Paling Atas)</h2>
        <p class="text-xs text-neutral-500 mb-5">Tampilan pertama yang dilihat pengunjung, termasuk background foto lokasi kios.</p>

        <div class="space-y-4">
            <div>
                <label class="block text-sm mb-1">Badge Kecil (di atas judul)</label>
                <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Judul Hero</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm mb-1">Subjudul Hero</label>
                    <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Foto Background (lokasi kios)</label>
                <input type="file" name="hero_bg_image" accept="image/*" class="w-full border rounded-lg px-3 py-2 text-sm">
                @if($settings['hero_bg_image'])
                    <img src="{{ asset($settings['hero_bg_image']) }}" class="w-full h-36 object-cover rounded-lg mt-2 border">
                @endif
                <p class="text-xs text-neutral-400 mt-1">Upload foto tampak depan kios / lokasi usaha untuk background hero. Kosongkan jika tidak ingin mengganti.</p>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Nilai Rating</label>
                    <input type="text" name="rating_value" value="{{ old('rating_value', $settings['rating_value']) }}" placeholder="4.9" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm mb-1">Jumlah Pelanggan Puas</label>
                    <input type="text" name="rating_count" value="{{ old('rating_count', $settings['rating_count']) }}" placeholder="200+" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
        </div>
    </div>

    {{-- ============ STATISTIK ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Statistik (4 Kartu Angka)</h2>
        <p class="text-xs text-neutral-500 mb-5">Tampil sebagai deretan angka di bawah hero, mis. jumlah item dikerjakan, tahun pengalaman, dll. Kosongkan salah satu pasangan Nilai/Label untuk menghilangkan kartu tersebut.</p>

        <div class="grid sm:grid-cols-2 gap-4">
            @for ($i = 0; $i < 4; $i++)
                @php $stat = $settings['stats'][$i] ?? ['value' => '', 'label' => '']; @endphp
                <div class="border rounded-lg p-4 space-y-2">
                    <p class="text-xs font-medium text-neutral-400">Kartu #{{ $i + 1 }}</p>
                    <input type="text" name="stats[{{ $i }}][value]" value="{{ old("stats.$i.value", $stat['value']) }}" placeholder="Nilai, mis. 1.200+" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <input type="text" name="stats[{{ $i }}][label]" value="{{ old("stats.$i.label", $stat['label']) }}" placeholder="Label, mis. Item Dikerjakan" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            @endfor
        </div>
    </div>

    {{-- ============ TENTANG & LOKASI ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Tentang Usaha & Lokasi</h2>
        <p class="text-xs text-neutral-500 mb-5">Ditampilkan sebagai section "Tentang Kami" beserta alamat & peta lokasi kios.</p>

        <div class="space-y-4">
            <div>
                <label class="block text-sm mb-1">Tentang Usaha</label>
                <textarea name="about_text" rows="4" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('about_text', $settings['about_text']) }}</textarea>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Alamat Kios</label>
                    <input type="text" name="address" value="{{ old('address', $settings['address']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm mb-1">No. Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings['phone']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Embed Google Maps (opsional, paste kode iframe)</label>
                <textarea name="maps_embed" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm font-mono text-xs">{{ old('maps_embed', $settings['maps_embed']) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ============ KENAPA PILIH KAMI ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Kenapa Pilih Kami (4 Fitur)</h2>
        <p class="text-xs text-neutral-500 mb-5">Icon bisa berupa emoji (mis. ⚡ 🛡️ 📱 👨‍🔧). Kosongkan judul & deskripsi untuk menghilangkan kartu tersebut.</p>

        <div>
            <label class="block text-sm mb-1">Judul Section</label>
            <input type="text" name="why_title" value="{{ old('why_title', $settings['why_title']) }}" class="w-full border rounded-lg px-3 py-2 text-sm mb-4">
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            @for ($i = 0; $i < 4; $i++)
                @php $f = $settings['features'][$i] ?? ['icon' => '', 'title' => '', 'desc' => '']; @endphp
                <div class="border rounded-lg p-4 space-y-2">
                    <p class="text-xs font-medium text-neutral-400">Fitur #{{ $i + 1 }}</p>
                    <input type="text" name="features[{{ $i }}][icon]" value="{{ old("features.$i.icon", $f['icon']) }}" placeholder="Icon / emoji" class="w-20 border rounded-lg px-3 py-2 text-sm text-center">
                    <input type="text" name="features[{{ $i }}][title]" value="{{ old("features.$i.title", $f['title']) }}" placeholder="Judul fitur" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <textarea name="features[{{ $i }}][desc]" rows="2" placeholder="Deskripsi singkat" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old("features.$i.desc", $f['desc']) }}</textarea>
                </div>
            @endfor
        </div>
    </div>

    {{-- ============ PROSES PENGERJAAN ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Proses Pengerjaan (5 Tahap)</h2>
        <p class="text-xs text-neutral-500 mb-5">Nomor tahap (01–05) otomatis mengikuti urutan. Kosongkan judul & deskripsi untuk menghilangkan tahap tersebut.</p>

        <div class="space-y-3">
            @for ($i = 0; $i < 5; $i++)
                @php $s = $settings['proses'][$i] ?? ['title' => '', 'desc' => '']; @endphp
                <div class="border rounded-lg p-4 flex gap-3 items-start">
                    <span class="text-xs font-bold text-neutral-300 pt-2.5 w-8 shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="flex-1 grid sm:grid-cols-2 gap-2">
                        <input type="text" name="proses[{{ $i }}][title]" value="{{ old("proses.$i.title", $s['title']) }}" placeholder="Judul tahap" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <input type="text" name="proses[{{ $i }}][desc]" value="{{ old("proses.$i.desc", $s['desc']) }}" placeholder="Deskripsi singkat" class="w-full border rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- ============ CTA PENUTUP ============ --}}
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="font-semibold text-neutral-800 mb-1">Call To Action Penutup</h2>
        <p class="text-xs text-neutral-500 mb-5">Kotak ajakan order di bagian paling bawah halaman, sebelum footer.</p>

        <div class="space-y-4">
            <div>
                <label class="block text-sm mb-1">Judul CTA</label>
                <input type="text" name="cta_title" value="{{ old('cta_title', $settings['cta_title']) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Teks CTA</label>
                <textarea name="cta_text" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('cta_text', $settings['cta_text']) }}</textarea>
            </div>
        </div>
    </div>

    <div class="sticky bottom-4 flex justify-end">
        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-lg">
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
