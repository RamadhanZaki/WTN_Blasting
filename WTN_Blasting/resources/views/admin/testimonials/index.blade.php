@extends('layouts.admin')
@section('title', 'Testimoni - Admin WTN BLASTING')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Testimoni</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-neutral-900 text-white px-4 py-2 rounded-lg text-sm">+ Tambah Testimoni</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($testimonials as $t)
        <div class="bg-white rounded-xl shadow-sm border p-4">
            @if($t->image_url)
                <img src="{{ $t->image_url }}" class="w-full h-32 object-cover rounded mb-3">
            @endif
            <p class="text-sm font-semibold">{{ $t->customer_name }} <span class="text-xs text-neutral-400">({{ $t->rating }}★)</span></p>
            <p class="text-xs text-neutral-500 mt-1">{{ Str::limit($t->content, 100) }}</p>
            <p class="text-xs mt-2 {{ $t->is_published ? 'text-green-600' : 'text-neutral-400' }}">{{ $t->is_published ? 'Tampil' : 'Disembunyikan' }}</p>
            <div class="flex gap-3 mt-2 text-xs">
                <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-orange-600 hover:underline">Edit</a>
                <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus testimoni ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-neutral-400">Belum ada testimoni.</p>
    @endforelse
</div>
<div class="mt-6">{{ $testimonials->links() }}</div>
@endsection
