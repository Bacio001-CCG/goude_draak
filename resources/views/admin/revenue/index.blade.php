@extends('layouts.admin-app')
@section('header')
Omzet
@endsection
@section('content')

<div class="flex gap-5">
    <div class="flex flex-col">
        <label for="">Vanaf</label>
        <input type="date" class="w-[15rem] border rounded-lg p-1">
    </div>
    <div class="flex flex-col"> <label for="">Tot</label>
        <input type="date" class="w-[15rem] border rounded-lg p-1">
    </div>
</div>

<div class="mt-10 w-[40rem] bg-white p-5 rounded-xl mx-auto">
    <h1 class="text-2xl font-bold pb-2 border-b">Omzet</h1>
    <div class="flex justify-between mt-2 bg-gray-100">
        <p>Order</p>
        <p>Tijd</p>
        <p>Bedrag</p>
    </div>
    @foreach ($orders as $item)
    <a href="{{route('checkout.show', ['checkout' => $item])}}" class="flex justify-between mt-2">
        <p>{{$item->id}}.</p>
        <p>{{Carbon\Carbon::parse($item->created_at)->format('h:i d/m/y')}}</p>
        @php
        $total = 0;
        foreach ($item->orders_products as $order) {
        $total += $order->product->price;
        }
        @endphp
        <p>€{{$total}}</p>
    </a>
    @endforeach
</div>
@endsection