@extends('layouts.admin')
@section('title', ($testimonial->exists ? 'Edit' : 'Tambah') . ' Testimoni - Admin WTN BLASTING')

@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $testimonial->exists ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h1>

<form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}"
    enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border p-6 max-w-lg space-y-4">
    @csrf
    @if($testimonial->exists) @method('PUT') @endif

    <div>
        <label class="block text-sm mb-1">Nama Customer</label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}" required class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm mb-1">Isi Testimoni</label>
        <textarea name="content" rows="4" required class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('content', $testimonial->content) }}</textarea>
    </div>
    <div>
        <label class="block text-sm mb-1">Foto Hasil Kerja (opsional)</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2 text-sm">
        @if($testimonial->image_url)
            <img src="{{ $testimonial->image_url }}" class="w-20 h-20 object-cover rounded mt-2">
        @endif
    </div>
    <div>
        <label class="block text-sm mb-1">Rating</label>
        <select name="rating" class="w-full border rounded-lg px-3 py-2 text-sm">
            @for($i=5;$i>=1;$i--)
                <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ $i }} Bintang</option>
            @endfor
        </select>
    </div>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $testimonial->is_published ?? true) ? 'checked' : '' }}>
        <label for="is_published" class="text-sm">Tampilkan di landing page</label>
    </div>

    <button type="submit" class="bg-orange-600 text-white px-5 py-2 rounded-lg text-sm">Simpan</button>
</form>
@endsection
