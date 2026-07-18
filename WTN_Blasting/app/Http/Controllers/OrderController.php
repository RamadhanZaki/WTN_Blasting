<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProgressLog;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Form order
    public function create()
    {
        return view('landing.order-create');
    }

    // Simpan order baru dari customer
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'    => 'required|string|max:100',
            'phone'            => 'required|string|max:30',
            'item_description' => 'required|string|max:1000',
            'service_type'     => 'required|in:powder_coating,vaporblasting,both',
            'photo'            => 'required|image|max:5120', // max 5MB
        ]);

        $path = $request->file('photo')->store('orders', 'public');

        $order = Order::create([
            'order_code'       => Order::generateOrderCode(),
            'customer_name'    => $data['customer_name'],
            'phone'            => $data['phone'],
            'item_description' => $data['item_description'],
            'service_type'     => $data['service_type'],
            'photo'            => $path,
            'acc_status'       => 'pending',
            'current_stage'    => 'menunggu_acc',
        ]);

        OrderProgressLog::create([
            'order_id'  => $order->id,
            'stage'     => 'menunggu_acc',
            'note'      => 'Order diterima, menunggu konfirmasi (ACC) dari admin.',
            'logged_at' => now(),
        ]);

        return redirect()
            ->route('order.track.show', $order->order_code)
            ->with('success', 'Order berhasil dikirim! Simpan kode order kamu untuk melacak progres: ' . $order->order_code);
    }

    // Form input kode tracking
    public function trackForm()
    {
        return view('landing.order-track');
    }

    // Tampilkan progres order berdasarkan kode
    public function trackShow(string $orderCode)
    {
        $order = Order::with('progressLogs')->where('order_code', $orderCode)->firstOrFail();
        return view('landing.order-track-result', compact('order'));
    }

    public function trackSubmit(Request $request)
    {
        $request->validate(['order_code' => 'required|string']);
        return redirect()->route('order.track.show', $request->order_code);
    }
}
