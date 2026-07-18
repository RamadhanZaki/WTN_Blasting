<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - WTN BLASTING')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-100 text-neutral-900">
<div class="flex min-h-screen">
    <aside class="w-64 bg-neutral-900 text-white flex-shrink-0">
        <div class="px-5 py-5 text-lg font-bold border-b border-neutral-800">
            WTN <span class="text-orange-500">BLASTING</span><br><span class="text-xs font-normal text-neutral-400">Admin Panel</span>
        </div>
        <nav class="mt-4 flex flex-col text-sm">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 hover:bg-neutral-800 {{ request()->routeIs('admin.dashboard') ? 'bg-neutral-800 text-orange-400' : '' }}">Dashboard</a>
            <a href="{{ route('admin.orders.index') }}" class="px-5 py-3 hover:bg-neutral-800 {{ request()->routeIs('admin.orders.*') ? 'bg-neutral-800 text-orange-400' : '' }}">Orderan / Antrean</a>
            <a href="{{ route('admin.products.index') }}" class="px-5 py-3 hover:bg-neutral-800 {{ request()->routeIs('admin.products.*') ? 'bg-neutral-800 text-orange-400' : '' }}">Produk</a>
            <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-3 hover:bg-neutral-800 {{ request()->routeIs('admin.testimonials.*') ? 'bg-neutral-800 text-orange-400' : '' }}">Testimoni</a>
            <a href="{{ route('admin.landing.edit') }}" class="px-5 py-3 hover:bg-neutral-800 {{ request()->routeIs('admin.landing.*') ? 'bg-neutral-800 text-orange-400' : '' }}">Edit Landing Page</a>
            <a href="{{ route('landing.index') }}" target="_blank" class="px-5 py-3 hover:bg-neutral-800 text-neutral-400">Lihat Website &rarr;</a>
            <form method="POST" action="{{ route('logout') }}" class="px-5 py-3">
                @csrf
                <button class="text-red-400 hover:text-red-300">Logout</button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
