
@extends('layouts.restaurant-app')

@section('content')
    <div>        
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-5">
            {{session('success')}}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-500 text-white p-3 rounded-lg mb-5">
            {{session('error')}}
        </div>
        @endif
        <div class="flex justify-between">
            <h2 class="font-bold text-2xl">Tafel: {{$table->id}}</h2>             
            <a href="{{ route('table.paymentScreen', $table) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                Betalen
            </a>
        </div>
        @if($table->tableOrder->round() < 5)
            <div>
                <order-form 
                    :categories="{{$categories}}"                     
                    :pastorders="{{$pastOrders}}" 
                    :tableid="{{$table->id}}" 
                    :lastplacedorder="'{{ \Carbon\Carbon::parse($table->tableOrder->last_placed_round)->format('Y-m-d\TH:i:s') }}'"
                    :round="{{$table->tableOrder->round()}}"
                />
            </div>
        @else
            <div>
                <p class="mb-5">Alle rondes zijn voltooid. Bedankt voor uw bezoek!</p>   
            </div>
        @endif
    </div>
@endsection