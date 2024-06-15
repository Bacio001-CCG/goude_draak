@extends('layouts.checkout-app')
@section('header')
Bestellingen \ #{{$order->id}}
@endsection
@section('content')
    @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded-lg mb-5">
        {{session('success')}}
    </div>
    @endif
<div id="app" class="grid grid-cols-2 gap-5">    
    <div>
        <product-list :typeoforder="'{{$order->type}}'" :checkoutid="'{{$order->id}}'" :categories="{{$categories}}" />
    </div>
    <div>
        <order-display-list :checkoutid="'{{$order->id}}'" :orderproducts="{{$order_products}}" />
    </div>
</div>
@endsection