@extends('layouts.admin')
@section('title', 'Dashboard - Admin WTN BLASTING')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-10">
    <div class="bg-white rounded-xl p-5 shadow-sm border">
        <p class="text-xs text-neutral-500">Order Pending ACC</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border">
        <p class="text-xs text-neutral-500">Sedang Dikerjakan</p>
        <p class="text-2xl font-bold text-orange-600">{{ $stats['in_progress'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border">
        <p class="text-xs text-neutral-500">Selesai Bulan Ini</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['done_this_month'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border">
        <p class="text-xs text-neutral-500">Total Produk</p>
        <p class="text-2xl font-bold">{{ $stats['total_products'] }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border">
        <p class="text-xs text-neutral-500">Total Testimoni</p>
        <p class="text-2xl font-bold">{{ $stats['total_testimonials'] }}</p>
    </div>
</div>

<h2 class="text-lg font-semibold mb-4">Order Terbaru</h2>
<div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-neutral-50 text-neutral-500">
            <tr>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Layanan</th>
                <th class="px-4 py-3">ACC</th>
                <th class="px-4 py-3">Tahap</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr class="border-t">
                <td class="px-4 py-3 font-medium">{{ $order->order_code }}</td>
                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                <td class="px-4 py-3">{{ $order->service_type }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs
                        {{ $order->acc_status === 'approved' ? 'bg-green-100 text-green-700' : ($order->acc_status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ $order->acc_status }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $order->stage_label }}</td>
                <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-orange-600 hover:underline">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
