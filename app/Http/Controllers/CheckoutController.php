<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        return view('checkout.show', [
            'order' => Order::with('products')->with('orders_products')->find($order),
            'categories' => Category::with('products')->get(),
            'order_products' => OrderProduct::where('order_id', $order)->with('product')->with('order')->get(),
        ]);
    }

    public function add(Request $request)
    {

        OrderProduct::create([
            'order_id' => $request[1],
            'product_id' => $request[0],
        ]);

        return OrderProduct::where('order_id', $request[1])->with('order')->with('product')->get();
    }

    public function remove(Request $request)
    {
        OrderProduct::where('order_id', $request[1])->where('product_id', $request[0])->first()->delete();
        return OrderProduct::where('order_id', $request[1])->with('order')->with('product')->get();
    }

    public function noteAdd(Request $request)
    {
        OrderProduct::where('id', $request[0])->update(['note' => $request[1]]);
        return OrderProduct::where('order_id', $request[2])->with('order')->with('product')->get();
    }
}
