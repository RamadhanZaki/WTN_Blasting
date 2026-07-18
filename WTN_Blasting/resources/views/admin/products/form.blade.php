@extends('layouts.admin')
@section('title', ($product->exists ? 'Edit' : 'Tambah') . ' Produk - Admin WTN BLASTING')

@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $product->exists ? 'Edit Produk' : 'Tambah Produk' }}</h1>

<form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
    enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border p-6 max-w-lg space-y-4">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm mb-1">Judul</label>
        <input type="text" name="title" value="{{ old('title', $product->title) }}" required class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm mb-1">Kategori</label>
        <input type="text" name="category" value="{{ old('category', $product->category) }}" placeholder="Powder Coating / Vaporblasting" class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm mb-1">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description', $product->description) }}</textarea>
    </div>
    <div>
        <label class="block text-sm mb-1">Gambar {{ $product->exists ? '(kosongkan jika tidak ganti)' : '' }}</label>
        <input type="file" name="image" accept="image/*" {{ $product->exists ? '' : 'required' }} class="w-full border rounded-lg px-3 py-2 text-sm">
        @if($product->exists)
            <img src="{{ $product->image_url }}" class="w-20 h-20 object-cover rounded mt-2">
        @endif
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
        <label for="is_featured" class="text-sm">Tampilkan sebagai unggulan</label>
    </div>
    <div>
        <label class="block text-sm mb-1">Urutan Tampil</label>
        <input type="number" name="order" value="{{ old('order', $product->order) }}" class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <button type="submit" class="bg-orange-600 text-white px-5 py-2 rounded-lg text-sm">Simpan</button>
</form>
@endsection
