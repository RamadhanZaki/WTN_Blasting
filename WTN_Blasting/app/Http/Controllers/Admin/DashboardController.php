<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_orders'  => Order::where('acc_status', 'pending')->count(),
            'in_progress'     => Order::where('acc_status', 'approved')->where('current_stage', '!=', 'done')->count(),
            'done_this_month' => Order::where('current_stage', 'done')->whereMonth('updated_at', now()->month)->count(),
            'total_products'  => Product::count(),
            'total_testimonials' => Testimonial::count(),
        ];

        $recentOrders = Order::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
