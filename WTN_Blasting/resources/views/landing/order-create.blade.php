@extends('layouts.app')

@section('title', 'Order - WTN BLASTING')

@section('content')
<section class="max-w-lg mx-auto px-4 py-16">
    <h1 class="text-2xl font-bold mb-2">Order Pengerjaan</h1>
    <p class="text-neutral-400 mb-8 text-sm">Isi form di bawah dan upload foto barang yang akan dikerjakan. Order kamu akan diproses admin (ACC) sebelum masuk antrean.</p>

    @if ($errors->any())
        <div class="bg-red-900/40 border border-red-600 text-red-300 px-4 py-3 rounded-lg text-sm mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm mb-1">Nama Lengkap</label>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                class="w-full bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-2 focus:outline-none focus:border-wtn-orange">
        </div>

        <div>
            <label class="block text-sm mb-1">No. WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="0812xxxxxxxx"
                class="w-full bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-2 focus:outline-none focus:border-wtn-orange">
        </div>

        <div>
            <label class="block text-sm mb-1">Jenis Layanan</label>
            <select name="service_type" required class="w-full bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-2">
                <option value="powder_coating">Powder Coating</option>
                <option value="vaporblasting">Vaporblasting</option>
                <option value="both">Keduanya</option>
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Deskripsi Barang</label>
            <textarea name="item_description" rows="4" required placeholder="Contoh: Velg mobil 4 pcs, warna hitam doff"
                class="w-full bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-2 focus:outline-none focus:border-wtn-orange">{{ old('item_description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm mb-1">Foto Barang</label>
            <input type="file" name="photo" accept="image/*" required
                class="w-full bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-2 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:bg-wtn-orange file:text-black">
        </div>

        <button type="submit" class="w-full bg-wtn-orange text-black font-semibold py-3 rounded-full hover:bg-orange-500">
            Kirim Order
        </button>
    </form>
</section>
@endsection
