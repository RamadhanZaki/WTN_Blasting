@extends('layouts.app')

@section('title', $settings['hero_title'] . ' - Powder Coating & Vaporblasting')

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative min-h-[92vh] flex items-center overflow-hidden bg-grid"
    style="background-image: linear-gradient(100deg, rgba(10,10,10,.92) 15%, rgba(10,10,10,.6) 45%, rgba(10,10,10,.25) 75%), linear-gradient(to bottom, transparent 60%, rgba(10,10,10,1) 100%), url('{{ asset($settings['hero_bg_image']) }}'); background-size: cover; background-position: center;">

    <div class="absolute -top-32 -left-20 w-[600px] h-[600px] bg-wtn-orange/20 blur-[160px] rounded-full pointer-events-none"></div>

    <div class="relative max-w-6xl w-full mx-auto px-6 pt-16">
        <div class="max-w-xl">
            <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 text-neutral-300 text-xs font-medium px-4 py-1.5 rounded-full mb-6">
                <span class="h-1.5 w-1.5 rounded-full bg-wtn-orange animate-pulse"></span>
                {{ $settings['hero_badge'] }}
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-[1.1]">
                {{ $settings['hero_title'] }}
            </h1>
            <p class="mt-5 text-base md:text-lg text-neutral-300">
                {{ $settings['hero_subtitle'] }}
            </p>

            <div class="mt-9 flex gap-3 flex-wrap">
                <a href="{{ route('order.create') }}"
                   class="inline-flex items-center gap-2 bg-wtn-orange text-black font-semibold px-7 py-3.5 rounded-full shadow-glow hover:bg-white transition text-sm md:text-base">
                    Order Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
                <a href="{{ route('order.track.form') }}"
                   class="inline-flex items-center gap-2 border border-white/15 bg-white/5 backdrop-blur px-7 py-3.5 rounded-full hover:bg-white/10 transition text-sm md:text-base">
                    Lacak Order Saya
                </a>
            </div>

            <div class="mt-10 flex items-center gap-2 text-sm text-neutral-400">
                <span class="text-wtn-orange">★★★★★</span>
                <span>{{ $settings['rating_value'] }}/5 dari {{ $settings['rating_count'] }} pelanggan puas</span>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-wtn-dark to-transparent"></div>
</section>

{{-- ============ STATS BAR ============ --}}
<section class="relative -mt-16 z-10 px-4">
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($settings['stats'] as $stat)
            <div class="bg-neutral-900/70 border border-white/10 backdrop-blur rounded-2xl px-4 py-6 text-center">
                <p class="text-2xl md:text-3xl font-extrabold text-white">{{ $stat['value'] }}</p>
                <p class="text-xs md:text-sm text-neutral-400 mt-1">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ TENTANG + LOKASI ============ --}}
@if($settings['about_text'] || $settings['address'])
<section class="max-w-4xl mx-auto px-4 py-20 text-center">
    <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3">Tentang Kami</p>
    <p class="text-neutral-300 leading-relaxed text-lg">{{ $settings['about_text'] }}</p>
    @if($settings['address'])
        <div class="mt-6 inline-flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm text-neutral-400">
            <span class="inline-flex items-center gap-1.5">📍 {{ $settings['address'] }}</span>
            @if($settings['phone'])
                <span class="inline-flex items-center gap-1.5">📞 {{ $settings['phone'] }}</span>
            @endif
        </div>
    @endif
    @if($settings['maps_embed'])
        <div class="mt-8 rounded-2xl overflow-hidden border border-white/10">
            {!! $settings['maps_embed'] !!}
        </div>
    @endif
</section>
@endif

{{-- ============ KENAPA PILIH KAMI ============ --}}
<section class="max-w-6xl mx-auto px-4 py-8 pb-20">
    <div class="text-center max-w-xl mx-auto mb-12">
        <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3">Kenapa WTN Blasting</p>
        <h2 class="text-2xl md:text-4xl font-bold">{{ $settings['why_title'] }}</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($settings['features'] as $f)
            <div class="group bg-neutral-900/50 border border-white/10 rounded-2xl p-6 hover:border-wtn-orange/40 hover:bg-neutral-900 transition">
                <div class="h-11 w-11 rounded-xl bg-wtn-orange/10 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">{{ $f['icon'] }}</div>
                <p class="font-semibold mb-1.5">{{ $f['title'] }}</p>
                <p class="text-sm text-neutral-400 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ 1. HASIL PRODUK ============ --}}
<section id="produk" class="max-w-6xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
        <div>
            <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3">Portfolio</p>
            <h2 class="text-2xl md:text-3xl font-bold">Hasil Produk Kami</h2>
            <p class="text-neutral-400 mt-2">Beberapa hasil pengerjaan powder coating & vaporblasting terbaik.</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($products as $product)
            <div class="group relative rounded-2xl overflow-hidden border border-white/10 aspect-square">
                <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/10 to-transparent"></div>
                @if($product->is_featured)
                    <span class="absolute top-3 left-3 bg-wtn-orange text-black text-[10px] font-bold px-2.5 py-1 rounded-full">FEATURED</span>
                @endif
                <div class="absolute inset-x-0 bottom-0 p-4 translate-y-1 group-hover:translate-y-0 transition">
                    <p class="text-sm font-semibold">{{ $product->title }}</p>
                    <p class="text-xs text-neutral-300">{{ $product->category }}</p>
                </div>
            </div>
        @empty
            <p class="text-neutral-500 col-span-4 text-center py-12">Belum ada produk ditampilkan.</p>
        @endforelse
    </div>
</section>

{{-- ============ PROSES PENGERJAAN ============ --}}
<section id="proses" class="bg-neutral-950 border-y border-white/5">
    <div class="max-w-6xl mx-auto px-4 py-20">
        <div class="text-center max-w-xl mx-auto mb-14">
            <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3">Alur Kerja</p>
            <h2 class="text-2xl md:text-4xl font-bold">Proses Pengerjaan Barangmu</h2>
            <p class="text-neutral-400 mt-3">Setiap order melewati tahapan berikut, dan bisa kamu pantau lewat fitur tracking.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach ($settings['proses'] as $i => $s)
                <div class="relative bg-neutral-900/60 border border-white/10 rounded-2xl p-5">
                    <p class="text-3xl font-extrabold text-white/10 mb-2">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="font-semibold text-sm mb-1.5">{{ $s['title'] }}</p>
                    <p class="text-xs text-neutral-400 leading-relaxed">{{ $s['desc'] }}</p>
                    @if($i < count($settings['proses']) - 1)
                        <div class="hidden lg:block absolute top-1/2 -right-2.5 -translate-y-1/2 text-neutral-700">›</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ 2. ANTREAN SEKARANG ============ --}}
<section id="antrean" class="max-w-6xl mx-auto px-4 py-20">
    <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3">Live Status</p>
    <div class="flex items-end justify-between flex-wrap gap-4 mb-8">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold">Antrean Sekarang</h2>
            <p class="text-neutral-400 mt-2">Status orderan yang sedang dalam proses pengerjaan.</p>
        </div>
        <a href="{{ route('order.track.form') }}" class="text-sm text-wtn-orange hover:text-white transition font-medium">Cek order saya →</a>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-white/10">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-white/[0.03] text-neutral-400">
                    <th class="py-3.5 pr-4 pl-5 font-medium">No. Antrean</th>
                    <th class="py-3.5 pr-4 font-medium">Kode Order</th>
                    <th class="py-3.5 pr-4 font-medium">Tahap Saat Ini</th>
                    <th class="py-3.5 pr-4 pl-4 font-medium">Progres</th>
                </tr>
            </thead>
            <tbody>
                @forelse($currentQueue as $order)
                    <tr class="border-t border-white/5 hover:bg-white/[0.02] transition">
                        <td class="py-4 pr-4 pl-5 font-bold text-wtn-orange">#{{ $order->queue_number }}</td>
                        <td class="py-4 pr-4 text-neutral-300 font-mono text-xs md:text-sm">{{ $order->order_code }}</td>
                        <td class="py-4 pr-4">
                            <span class="inline-flex items-center gap-1.5 bg-white/5 border border-white/10 rounded-full px-3 py-1 text-xs">
                                <span class="h-1.5 w-1.5 rounded-full bg-wtn-amber"></span>
                                {{ $order->stage_label }}
                            </span>
                        </td>
                        <td class="py-4 pr-5 pl-4 w-56">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-neutral-800 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-wtn-orange to-wtn-amber h-2 rounded-full" style="width: {{ $order->progress_percent }}%"></div>
                                </div>
                                <span class="text-xs text-neutral-400 w-9 text-right">{{ $order->progress_percent }}%</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-10 text-center text-neutral-500">Tidak ada antrean saat ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

{{-- ============ 5. TESTIMONI ============ --}}
<section id="testimoni" class="bg-neutral-950 border-y border-white/5">
    <div class="max-w-6xl mx-auto px-4 py-20">
        <p class="text-xs font-semibold tracking-widest text-wtn-orange uppercase mb-3 text-center">Testimoni</p>
        <h2 class="text-2xl md:text-4xl font-bold text-center">Apa Kata Customer Kami</h2>
        <p class="text-neutral-400 mt-3 text-center max-w-xl mx-auto mb-12">Kepuasan pelanggan adalah prioritas utama kami di setiap pengerjaan.</p>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($testimonials as $t)
                <div class="bg-neutral-900/60 border border-white/10 rounded-2xl p-6 hover:border-wtn-orange/30 transition">
                    <div class="flex items-center gap-3 mb-4">
                        @if($t->image_url)
                            <img src="{{ $t->image_url }}" class="h-11 w-11 rounded-full object-cover" alt="{{ $t->customer_name }}">
                        @else
                            <div class="h-11 w-11 rounded-full bg-wtn-orange/20 flex items-center justify-center text-wtn-orange font-bold">
                                {{ strtoupper(substr($t->customer_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm font-semibold">{{ $t->customer_name }}</p>
                            <div class="text-wtn-orange text-xs">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div>
                        </div>
                    </div>
                    <p class="text-neutral-300 text-sm leading-relaxed">&ldquo;{{ $t->content }}&rdquo;</p>
                </div>
            @empty
                <p class="text-neutral-500 md:col-span-3 text-center py-12">Belum ada testimoni.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ============ CTA PENUTUP ============ --}}
<section class="max-w-6xl mx-auto px-4 py-24">
    <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-neutral-900/60 px-6 py-16 text-center">
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-wtn-orange/20 blur-[140px] rounded-full pointer-events-none"></div>
        <div class="relative">
            <h2 class="text-2xl md:text-4xl font-bold mb-4">{{ $settings['cta_title'] }}</h2>
            <p class="text-neutral-400 max-w-lg mx-auto mb-8">{{ $settings['cta_text'] }}</p>
            <a href="{{ route('order.create') }}"
               class="inline-flex items-center gap-2 bg-wtn-orange text-black font-semibold px-8 py-3.5 rounded-full shadow-glow hover:bg-white transition">
                Order Sekarang
            </a>
        </div>
    </div>
</section>

@endsection
