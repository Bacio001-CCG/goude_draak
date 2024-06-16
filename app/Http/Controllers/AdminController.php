<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        return view('admin.index');
    }

    public function revenue()
    {
        return view('admin.revenue.index', [
            'orders' => Order::all()
        ]);
    }
}
