<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProgressLog;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->latest();

        if ($request->filled('status')) {
            $query->where('acc_status', $request->status);
        }
        if ($request->filled('stage')) {
            $query->where('current_stage', $request->stage);
        }
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_code', 'like', "%{$request->q}%")
                  ->orWhere('customer_name', 'like', "%{$request->q}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('progressLogs');
        return view('admin.orders.show', compact('order'));
    }

    // ACC / tolak order
    public function updateAcc(Request $request, Order $order)
    {
        $data = $request->validate([
            'acc_status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string|max:500',
        ]);

        $order->acc_status = $data['acc_status'];
        $order->admin_note = $data['admin_note'] ?? null;

        if ($data['acc_status'] === 'approved') {
            // masukkan ke antrean: nomor antrean = jumlah order approved saat ini + 1
            $maxQueue = Order::where('acc_status', 'approved')->max('queue_number') ?? 0;
            $order->queue_number = $maxQueue + 1;
            $order->current_stage = 'cleaning';

            OrderProgressLog::create([
                'order_id' => $order->id,
                'stage' => 'cleaning',
                'note' => 'Order di-ACC admin dan masuk antrean nomor ' . $order->queue_number,
                'logged_at' => now(),
            ]);
        } else {
            OrderProgressLog::create([
                'order_id' => $order->id,
                'stage' => 'menunggu_acc',
                'note' => 'Order ditolak: ' . ($data['admin_note'] ?? '-'),
                'logged_at' => now(),
            ]);
        }

        $order->save();

        return back()->with('success', 'Status order berhasil diperbarui.');
    }

    // Update tahap progres pengerjaan
    public function updateStage(Request $request, Order $order)
    {
        $data = $request->validate([
            'current_stage' => 'required|in:cleaning,remove_cat,remove_chrome,sandblasting,vaporblasting,powder_coating,oven,finishing,done',
            'note' => 'nullable|string|max:500',
        ]);

        $order->current_stage = $data['current_stage'];
        $order->save();

        OrderProgressLog::create([
            'order_id' => $order->id,
            'stage' => $data['current_stage'],
            'note' => $data['note'] ?? null,
            'logged_at' => now(),
        ]);

        return back()->with('success', 'Progres order diperbarui ke: ' . Order::STAGES[$data['current_stage']]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order dihapus.');
    }
}
