<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        return view('admin.index');
    }

    public function revenue(Request $request)
    {
        $dateFrom = $request->input('date_from') ?? Carbon::now()->subDays(365);
        $dateTo = $request->input('date_to') ?? Carbon::now();

        $orders = Order::whereBetween('created_at', [$dateFrom, $dateTo])->get();

        $transactionPrice = Transaction::whereBetween('created_at', [$dateFrom, $dateTo])->sum('price');
        return view('admin.revenue.index', [
            'orders' => $orders,
            'transactionPrice' => $transactionPrice,
        ]);
    }
}
