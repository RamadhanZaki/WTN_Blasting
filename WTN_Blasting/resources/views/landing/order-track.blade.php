@extends('layouts.app')

@section('title', 'Tracking Order - WTN BLASTING')

@section('content')
<section class="max-w-md mx-auto px-4 py-24 text-center">
    <h1 class="text-2xl font-bold mb-2">Lacak Progres Order</h1>
    <p class="text-neutral-400 mb-8 text-sm">Masukkan kode order yang kamu terima saat mengirim order (contoh: WTN-20260719-0001).</p>

    <form action="{{ route('order.track.submit') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="order_code" required placeholder="WTN-20260719-0001"
            class="flex-1 bg-neutral-900 border border-neutral-700 rounded-lg px-4 py-3 focus:outline-none focus:border-wtn-orange">
        <button type="submit" class="bg-wtn-orange text-black font-semibold px-5 rounded-lg hover:bg-orange-500">Cari</button>
    </form>
</section>
@endsection
