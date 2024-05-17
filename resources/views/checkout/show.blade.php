@extends('layouts.checkout-app')
@section('header')
Bestellingen \ #{{$order->id}}
@endsection
@section('content')
<div id="app" class="grid grid-cols-2 gap-5">
    <div>
        <product-list :checkoutid="{{$order->id}}" :products="{{$products}}" />
    </div>
    <div>
        <order-display-list :checkoutid="{{$order->id}}" :products="{{$order->products}}" />
    </div>
</div>
@endsection