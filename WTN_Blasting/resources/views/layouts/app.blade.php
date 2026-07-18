<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WTN BLASTING - Powder Coating & Vaporblasting')</title>
    <meta name="description" content="WTN Blasting - Jasa Powder Coating & Vaporblasting profesional">
    <link rel="icon" href="{{ asset('images/logo-wtn-blasting.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        wtn: {
                            dark: '#0a0a0a',
                            orange: '#ff6a00',
                            amber: '#ffb703',
                            steel: '#3a3a3a',
                        }
                    },
                    boxShadow: {
                        glow: '0 0 40px -10px rgba(255,106,0,.45)',
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { background-color: #0a0a0a; }
        .navbar-solid { background-color: rgba(10,10,10,.85); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); box-shadow: 0 8px 30px -12px rgba(0,0,0,.6); }
        .bg-grid {
            background-image: linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 42px 42px;
        }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 999px; }
    </style>
    @stack('styles')
</head>
<body class="bg-wtn-dark text-neutral-100 font-sans antialiased">

    {{-- ============ NAVBAR: seamless, blends into page, no divider line — solidifies subtly on scroll ============ --}}
    <nav id="site-nav" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-end pl-6 pr-3 md:pr-4 py-4">
            {{-- Bagian kanan: semua opsi (menu navigasi + tombol order) dalam satu grup --}}
            <div class="hidden md:flex items-center gap-9 text-[14.5px] font-medium text-neutral-300">
                <a href="{{ route('landing.index') }}#produk" class="hover:text-white transition">Produk</a>
                <a href="{{ route('landing.index') }}#proses" class="hover:text-white transition">Proses</a>
                <a href="{{ route('landing.index') }}#antrean" class="hover:text-white transition">Antrean</a>
                <a href="{{ route('landing.index') }}#testimoni" class="hover:text-white transition">Testimoni</a>
                <a href="{{ route('order.track.form') }}" class="hover:text-white transition">Tracking</a>
                <a href="{{ route('order.create') }}"
                   class="inline-flex items-center gap-1.5 bg-wtn-orange text-black text-sm font-semibold px-5 py-2.5 rounded-full shadow-glow hover:bg-white transition">
                    Order Sekarang
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button id="nav-toggle" class="md:hidden text-neutral-200 p-2 -mr-2" aria-label="Buka menu">
                <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile menu panel --}}
        <div id="nav-mobile" class="hidden md:hidden navbar-solid mx-4 mt-2 rounded-2xl overflow-hidden">
            <div class="flex flex-col p-4 gap-1 text-sm font-medium text-neutral-200">
                <a href="{{ route('landing.index') }}#produk" class="px-3 py-2.5 rounded-lg hover:bg-white/5">Produk</a>
                <a href="{{ route('landing.index') }}#proses" class="px-3 py-2.5 rounded-lg hover:bg-white/5">Proses</a>
                <a href="{{ route('landing.index') }}#antrean" class="px-3 py-2.5 rounded-lg hover:bg-white/5">Antrean</a>
                <a href="{{ route('landing.index') }}#testimoni" class="px-3 py-2.5 rounded-lg hover:bg-white/5">Testimoni</a>
                <a href="{{ route('order.track.form') }}" class="px-3 py-2.5 rounded-lg hover:bg-white/5">Tracking</a>
                <a href="{{ route('order.create') }}" class="mt-2 text-center bg-wtn-orange text-black font-semibold px-4 py-2.5 rounded-full">Order Sekarang</a>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="max-w-3xl mx-auto pt-24 px-4">
                <div class="bg-green-900/40 border border-green-600 text-green-300 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    {{-- ============ FOOTER ============ --}}
    <footer class="relative border-t border-white/5 mt-24 bg-neutral-950">
        <div class="max-w-6xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-2">
                <img src="{{ asset('images/logo-wtn-blasting.png') }}" alt="WTN Blasting" class="h-9 w-auto mb-4">
                <p class="text-sm text-neutral-400 leading-relaxed max-w-sm">
                    Jasa powder coating & vaporblasting profesional untuk velg, sparepart motor/mobil, dan komponen metal lainnya. Hasil rapi, tahan lama, dikerjakan tim berpengalaman.
                </p>
                <div class="flex gap-3 mt-5">
                    <a href="#" class="h-9 w-9 rounded-full bg-white/5 hover:bg-wtn-orange hover:text-black flex items-center justify-center transition" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zm-5 3.5A5.5 5.5 0 1017.5 13 5.51 5.51 0 0012 6.5zm0 2A3.5 3.5 0 118.5 12 3.5 3.5 0 0112 8.5zM18 5.75a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z"/></svg>
                    </a>
                    <a href="#" class="h-9 w-9 rounded-full bg-white/5 hover:bg-wtn-orange hover:text-black flex items-center justify-center transition" aria-label="WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.87.5 3.7 1.44 5.31L2 22l4.9-1.53a9.9 9.9 0 004.14.91h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.86 9.86 0 0012.04 2zm5.8 14.05c-.24.68-1.4 1.32-1.93 1.4-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.89-1.25-4.78-4.15-4.92-4.34-.14-.19-1.18-1.57-1.18-3 0-1.42.75-2.12 1.01-2.41.27-.29.58-.36.78-.36h.55c.18 0 .42-.03.65.5.24.55.81 1.9.88 2.04.07.14.11.3.02.49-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.29.29-.12.58.17.29.75 1.24 1.61 2.01 1.11.99 2.04 1.3 2.33 1.44.29.14.46.12.63-.07.17-.19.72-.84.91-1.13.19-.29.38-.24.65-.14.27.1 1.71.81 2 .96.29.14.48.22.55.34.07.13.07.72-.17 1.4z"/></svg>
                    </a>
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold text-white mb-4">Navigasi</p>
                <ul class="space-y-2.5 text-sm text-neutral-400">
                    <li><a href="{{ route('landing.index') }}#produk" class="hover:text-wtn-orange transition">Produk</a></li>
                    <li><a href="{{ route('landing.index') }}#proses" class="hover:text-wtn-orange transition">Proses Pengerjaan</a></li>
                    <li><a href="{{ route('order.create') }}" class="hover:text-wtn-orange transition">Order Sekarang</a></li>
                    <li><a href="{{ route('order.track.form') }}" class="hover:text-wtn-orange transition">Lacak Order</a></li>
                </ul>
            </div>
            <div>
                <p class="text-sm font-semibold text-white mb-4">Kontak</p>
                <ul class="space-y-2.5 text-sm text-neutral-400">
                    <li class="flex gap-2"><span>📍</span><span>{{ \App\Models\LandingSetting::get('address', 'Yogyakarta, Indonesia') }}</span></li>
                    <li class="flex gap-2"><span>📞</span><span>{{ \App\Models\LandingSetting::get('phone', '0812-xxxx-xxxx') }}</span></li>
                    <li class="flex gap-2"><span>🕒</span><span>Senin–Sabtu, 08.00–17.00</span></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/5">
            <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-neutral-500">
                <p>&copy; {{ date('Y') }} WTN BLASTING. All rights reserved.</p>
                <p>Powder Coating & Vaporblasting Specialist</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar: transparent over hero, solidifies with blur once scrolled — no visible divider line.
        const nav = document.getElementById('site-nav');
        const onScroll = () => {
            if (window.scrollY > 24) nav.classList.add('navbar-solid');
            else nav.classList.remove('navbar-solid');
        };
        onScroll();
        window.addEventListener('scroll', onScroll);

        // Mobile menu toggle
        const toggle = document.getElementById('nav-toggle');
        const mobile = document.getElementById('nav-mobile');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');
        toggle?.addEventListener('click', () => {
            mobile.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
