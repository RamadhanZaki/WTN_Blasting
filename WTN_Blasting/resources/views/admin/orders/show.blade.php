@extends('layouts.admin')
@section('title', 'Detail Order - Admin WTN BLASTING')

@section('content')
<a href="{{ route('admin.orders.index') }}" class="text-sm text-neutral-500 hover:underline">&larr; Kembali</a>

<div class="grid md:grid-cols-3 gap-6 mt-4">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-start gap-4">
                @if($order->photo_url)
                    <img src="{{ $order->photo_url }}" class="w-28 h-28 object-cover rounded-lg border">
                @endif
                <div>
                    <h1 class="text-xl font-bold">{{ $order->order_code }}</h1>
                    <p class="text-sm text-neutral-600">{{ $order->customer_name }} — {{ $order->phone }}</p>
                    <p class="text-sm text-neutral-500 mt-2">{{ $order->item_description }}</p>
                    <p class="text-xs text-neutral-400 mt-1">Layanan: {{ $order->service_type }}</p>
                </div>
            </div>
        </div>

        {{-- ACC Panel --}}
        @if($order->acc_status === 'pending')
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="font-semibold mb-3">Konfirmasi Order (ACC)</h2>
            <form method="POST" action="{{ route('admin.orders.acc', $order) }}" class="space-y-3">
                @csrf @method('PATCH')
                <textarea name="admin_note" placeholder="Catatan (opsional)" class="w-full border rounded-lg px-3 py-2 text-sm" rows="2"></textarea>
                <div class="flex gap-3">
                    <button type="submit" name="acc_status" value="approved" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm">Setujui & Masukkan Antrean</button>
                    <button type="submit" name="acc_status" value="rejected" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Tolak</button>
                </div>
            </form>
        </div>
        @endif

        {{-- Update Progres --}}
        @if($order->acc_status === 'approved')
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="font-semibold mb-3">Update Tahap Progres</h2>
            <p class="text-sm text-neutral-500 mb-3">Tahap saat ini: <strong>{{ $order->stage_label }}</strong></p>
            <form method="POST" action="{{ route('admin.orders.stage', $order) }}" class="space-y-3">
                @csrf @method('PATCH')
                <select name="current_stage" class="w-full border rounded-lg px-3 py-2 text-sm">
                    @foreach(\App\Models\Order::STAGES as $key => $label)
                        @continue($key === 'menunggu_acc')
                        <option value="{{ $key }}" @selected($order->current_stage === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <input type="text" name="note" placeholder="Catatan progres (opsional)" class="w-full border rounded-lg px-3 py-2 text-sm">
                <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-lg text-sm">Update Progres</button>
            </form>
        </div>
        @endif

        {{-- Riwayat --}}
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="font-semibold mb-3">Riwayat</h2>
            <div class="space-y-3 text-sm">
                @foreach($order->progressLogs->reverse() as $log)
                    <div class="border-l-2 pl-3">
                        <p>{{ $log->stage_label }} @if($log->note) — {{ $log->note }} @endif</p>
                        <p class="text-xs text-neutral-400">{{ $log->logged_at->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-xs text-neutral-500">Status ACC</p>
            <p class="font-semibold capitalize">{{ $order->acc_status }}</p>
            <p class="text-xs text-neutral-500 mt-3">No. Antrean</p>
            <p class="font-semibold">{{ $order->queue_number ?? '-' }}</p>
            <p class="text-xs text-neutral-500 mt-3">Progres</p>
            <div class="w-full bg-neutral-200 rounded-full h-2 mt-1">
                <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $order->progress_percent }}%"></div>
            </div>

            <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="mt-6" onsubmit="return confirm('Hapus order ini?')">
                @csrf @method('DELETE')
                <button class="text-red-600 text-sm hover:underline">Hapus Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
