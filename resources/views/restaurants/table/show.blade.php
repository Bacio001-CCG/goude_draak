
@extends('layouts.restaurant-app')

@section('content')
    <div>        
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-5">
            {{session('success')}}
        </div>
        @endif
        <div>
            <h2 class="font-bold text-2xl">Tafel: {{$table->id}}</h2>
        </div>
        @if($table->tableOrder->round < 5)
            <div>
                <order-form 
                    :categories="{{$categories}}" 
                    :tableid="{{$table->id}}" 
                    :lastplacedorder="'{{ \Carbon\Carbon::parse($table->tableOrder->last_placed_round)->format('Y-m-d\TH:i:s') }}'"
                    :round="{{$table->tableOrder->round}}"
                />
            </div>
        @else
            <div>
                <p>Alle rondes zijn voltooid. Bedankt voor uw bezoek!</p>
            </div>
        @endif
    </div>
@endsection