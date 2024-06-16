@extends('layouts.admin-app')
@section('header')
Omzet
@endsection
@section('content')

<form action="{{ route('admin.revenue.index') }}" method="GET">
    <div class="flex gap-5">
        <div class="flex flex-col">
            <label for="date_from">Vanaf</label>
            <input type="date" name="date_from" class="w-[15rem] border rounded-lg p-1">
        </div>
        <div class="flex flex-col">
            <label for="date_to">Tot</label>
            <input type="date" name="date_to" class="w-[15rem] border rounded-lg p-1">
        </div>
    </div>
    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Filter</button>
</form>

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

    <div class="mt-2 pt-2 border-t text-right">
        Sub Totaal: € {{$transactionPrice * 0.79}}
    </div>
    <div class="mt-2 pt-2 text-right">
        BTW: € {{$transactionPrice * 0.21}}
    </div>
    <div class="mt-2 pt-2 text-right">
        Totaal € {{$transactionPrice}}
    </div>
</div>
@endsection