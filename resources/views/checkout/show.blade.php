@extends('layouts.checkout-app')
@section('header')
Bestellingen \ #{{$order->id}}
@endsection
@section('content')
<div id="app" class="grid grid-cols-2 gap-5">
    <div>
        <product-list :typeoforder="'{{$order->type}}'" :checkoutid="'{{$order->id}}'" :categories="{{$categories}}" />
    </div>
    <div>
        <order-display-list :checkoutid="'{{$order->id}}'" :orderproducts="{{$order_products}}" />
    </div>
</div>
@endsection