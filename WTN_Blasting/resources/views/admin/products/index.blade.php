@extends('layouts.admin')
@section('title', 'Produk - Admin WTN BLASTING')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Produk / Hasil Kerja</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-neutral-900 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Produk</a>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse($products as $product)
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <img src="{{ $product->image_url }}" class="w-full h-32 object-cover">
            <div class="p-3">
                <p class="text-sm font-semibold truncate">{{ $product->title }}</p>
                <p class="text-xs text-neutral-500">{{ $product->category }}</p>
                <div class="flex gap-3 mt-2 text-xs">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-orange-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-neutral-400 col-span-4">Belum ada produk.</p>
    @endforelse
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection
