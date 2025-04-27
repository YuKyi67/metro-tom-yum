<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function viewAllOrders()
    {
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        return view('all-orders', compact('orders'));
    }

    public function updateStatus($id, Request $request)
    {
        DB::table('orders')->where('id', $id)->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated.');
    }

    public function cancel($id)
    {
        DB::table('orders')->where('id', $id)->update(['status' => 'Cancelled']);
        return back()->with('success', 'Order has been cancelled.');
    }

    public function salesReport()
{
    $sales = DB::table('orders')
        ->selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
        ->where('status', 'Completed')
        ->groupByRaw('DATE(created_at)')
        ->orderByDesc('date')
        ->get();

    return view('sales-report', compact('sales'));
}

}
