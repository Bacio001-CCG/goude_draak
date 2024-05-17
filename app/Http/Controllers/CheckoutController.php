<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController
{
    public function index()
    {
        return view('checkout.index', [
            'orders' => Order::all(),
        ]);
    }

    public function store(Request $request)
    {
        Order::create();
        Session::flash('success', 'Order is aangemaakt!');
        return redirect()->back();
    }

    public function show($order)
    {

        $products = [];
        $products = Product::all();

        return view('checkout.show', [
            'order' => Order::find($order),
            'products' => $products,
        ]);
    }

    public function add(Request $request)
    {
        OrderProduct::create([
            'order_id' => $request[1],
            'product_id' => $request[0],
        ]);
    }

    public function remove(Request $request)
    {
        OrderProduct::where('order_id', $request[1])->where('product_id', $request[0])->first()->delete();
        return $request;
    }
}
