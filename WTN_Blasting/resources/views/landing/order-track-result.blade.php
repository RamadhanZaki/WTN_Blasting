@extends('layouts.app')

@section('title', 'Tracking ' . $order->order_code . ' - WTN BLASTING')

@section('content')
<section class="max-w-2xl mx-auto px-4 py-16">
    <a href="{{ route('order.track.form') }}" class="text-sm text-neutral-400 hover:text-white">&larr; Cari kode lain</a>

    <div class="mt-4 flex items-center gap-4">
        @if($order->photo_url)
            <img src="{{ $order->photo_url }}" class="w-20 h-20 object-cover rounded-lg border border-neutral-800" alt="Foto barang">
        @endif
        <div>
            <h1 class="text-xl font-bold">{{ $order->order_code }}</h1>
            <p class="text-neutral-400 text-sm">{{ $order->customer_name }} — {{ $order->item_description }}</p>
        </div>
    </div>

    {{-- Status ACC --}}
    <div class="mt-6">
        @if($order->acc_status === 'pending')
            <span class="inline-block bg-yellow-900/40 text-yellow-300 border border-yellow-600 text-xs px-3 py-1 rounded-full">Menunggu konfirmasi admin (ACC)</span>
        @elseif($order->acc_status === 'rejected')
            <span class="inline-block bg-red-900/40 text-red-300 border border-red-600 text-xs px-3 py-1 rounded-full">Order ditolak{{ $order->admin_note ? ': '.$order->admin_note : '' }}</span>
        @else
            <span class="inline-block bg-green-900/40 text-green-300 border border-green-600 text-xs px-3 py-1 rounded-full">Disetujui — Antrean #{{ $order->queue_number }}</span>
        @endif
    </div>

    {{-- Progress bar keseluruhan --}}
    <div class="mt-6">
        <div class="flex justify-between text-xs text-neutral-400 mb-1">
            <span>Progres</span>
            <span>{{ $order->progress_percent }}%</span>
        </div>
        <div class="w-full bg-neutral-800 rounded-full h-2">
            <div class="bg-wtn-orange h-2 rounded-full transition-all" style="width: {{ $order->progress_percent }}%"></div>
        </div>
    </div>

    {{-- Timeline tahapan --}}
    <div class="mt-10">
        <h2 class="text-lg font-semibold mb-6">Timeline Tahapan Pengerjaan</h2>
        <ol class="relative border-l border-neutral-700 ml-2">
            @foreach(\App\Models\Order::STAGES as $stageKey => $stageLabel)
                @php
                    $stageKeys = array_keys(\App\Models\Order::STAGES);
                    $currentIndex = array_search($order->current_stage, $stageKeys);
                    $thisIndex = array_search($stageKey, $stageKeys);
                    $isDone = $thisIndex < $currentIndex;
                    $isCurrent = $thisIndex === $currentIndex;
                @endphp
                <li class="mb-6 ml-6">
                    <span class="absolute -left-[9px] flex items-center justify-center w-4 h-4 rounded-full
                        {{ $isDone ? 'bg-wtn-orange' : ($isCurrent ? 'bg-wtn-orange ring-4 ring-orange-900' : 'bg-neutral-700') }}">
                    </span>
                    <p class="text-sm font-medium {{ $isCurrent ? 'text-wtn-orange' : ($isDone ? 'text-white' : 'text-neutral-500') }}">
                        {{ $stageLabel }} @if($isCurrent) <span class="text-xs">(saat ini)</span> @endif
                    </p>
                </li>
            @endforeach
        </ol>
    </div>

    {{-- Riwayat catatan admin --}}
    @if($order->progressLogs->count())
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-3">Riwayat Update</h2>
            <div class="space-y-3">
                @foreach($order->progressLogs->reverse() as $log)
                    <div class="text-sm border-l-2 border-neutral-800 pl-3">
                        <p class="text-neutral-300">{{ $log->stage_label }} @if($log->note) — {{ $log->note }} @endif</p>
                        <p class="text-xs text-neutral-500">{{ $log->logged_at->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
