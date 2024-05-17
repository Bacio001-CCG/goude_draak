@extends('layouts.checkout-app')
@section('header')
Bestellingen
@endsection
@section('content')

<div class="flex flex-col gap-10">

    <form action="{{route('checkout.store')}}" method="POST">

        @csrf

        <button class=" bg-blue-500 text-white px-5 py-1 rounded-lg hover:bg-blue-500/50 w-fit" type="submit">
            <i class="fa-solid fa-plus mr-1"></i> Nieuwe Bestelling
        </button>

    </form>

    @if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded-lg mb-5">
        {{session('success')}}
    </div>
    @endif

    <order-list :orders="{{$orders}}" />

</div>

@endsection