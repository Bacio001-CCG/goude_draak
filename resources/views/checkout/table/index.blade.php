@extends('layouts.checkout-app')
@section('header')
Tafels
@endsection
@section('content')

<div class="flex flex-col gap-10">
    <div>
        <h2 class="font-bold text-2xl">Tafels:</h2>
    </div>       
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg mb-2">
            {{session('success')}}
        </div>
    @endif     
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tafel nummer</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Voltooide rondes</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Aantal personen</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Deluxe menu</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700">{{ $table->id }}</td>
                    @if($table->active_table_order_id)
                        <td class="px-4 py-2">{{$table->tableOrder->round}}/ 5</td>
                        <td class="px-4 py-2"> {{$table->tableOrder->customers->count()}} </td>
                        <td class="px-4 py-2"> {{$table->tableOrder->deluxe_menu ? 'ja' : 'nee'}} </td>
                        <td class="px-4 py-2 flex gap-6  items-center">
                            <a href="{{ route('checkout.show', $table->tableOrder->order) }}" class="font-semibold hover:underline">
                                Bekijk bestelling
                            </a>
                            <a href="{{ route('table.close', $table) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Sluiten
                            </a>
                        </td>
                    @else                        
                        <td class="px-4 py-2" colspan="3"></td>
                        <td class="px-4 py-2">
                            <a href="{{ route('table.edit', $table) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Activeer tafel
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection