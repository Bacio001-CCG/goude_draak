
@extends('layouts.restaurant-app')

@section('content')
    <div>
        <div>
            <h2 class="font-bold text-2xl">Tafel: {{$table->id}}</h2>
        </div>
        <div class="flex justify-between">
            <span>Bestellingen /5</span>
            <span>Volgende bestelling: </span>
        </div>
        <div>
            <order-form :categories="{{$categories}}" :tableid="{{$table->id}}"/>
        </div>
    </div>
@endsection