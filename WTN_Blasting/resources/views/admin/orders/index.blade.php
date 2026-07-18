@extends('layouts.admin')
@section('title', 'Orderan - Admin WTN BLASTING')

@section('content')
<h1 class="text-2xl font-bold mb-6">Orderan / Antrean</h1>

<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode / nama customer..."
        class="border rounded-lg px-3 py-2 text-sm w-64">
    <select name="status" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">Semua Status ACC</option>
        <option value="pending" @selected(request('status')=='pending')>Pending</option>
        <option value="approved" @selected(request('status')=='approved')>Approved</option>
        <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
    </select>
    <select name="stage" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">Semua Tahap</option>
        @foreach(\App\Models\Order::STAGES as $key => $label)
            <option value="{{ $key }}" @selected(request('stage')==$key)>{{ $label }}</option>
        @endforeach
    </select>
    <button class="bg-neutral-900 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
</form>

<div class="bg-white rounded-xl shadow-sm border overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-neutral-50 text-neutral-500">
            <tr>
                <th class="px-4 py-3">Antrean</th>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">ACC</th>
                <th class="px-4 py-3">Tahap</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $order->queue_number ?? '-' }}</td>
                <td class="px-4 py-3 font-medium">{{ $order->order_code }}</td>
                <td class="px-4 py-3">{{ $order->customer_name }} <br><span class="text-xs text-neutral-400">{{ $order->phone }}</span></td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs
                        {{ $order->acc_status === 'approved' ? 'bg-green-100 text-green-700' : ($order->acc_status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                        {{ $order->acc_status }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $order->stage_label }}</td>
                <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="text-orange-600 hover:underline">Kelola</a></td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-neutral-400">Belum ada order.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $orders->links() }}</div>
@endsection
