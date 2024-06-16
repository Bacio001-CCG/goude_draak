
@extends('layouts.restaurant-app')

@section('content')
    <div>        
        <div>
            <h2 class="font-bold text-2xl">Tafel: {{$table->id}}</h2>
        </div>
        <div id="bill">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 uppercase">
                <tr>
                    <th class="py-3 px-6 text-left">Product</th>
                    <th class="py-3 px-6 text-left">Aantal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderdProducts as $product)
                    <tr class="border-b">
                        <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            <p class="text-right">€{{ $table->tableOrder->order->products->sum('price') }}</p>
        </div>
        <div>              
            <a href="{{ route('table.pay', $table) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                Afrekenen
            </a>
        </div>
    </div>
@endsection