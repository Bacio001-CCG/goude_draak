
@extends('layouts.restaurant-app')

@section('content')
    <div>
        <div>
            <h2 class="font-bold text-2xl">Tafels:</h2>
        </div>        
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tafel nummer</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $table)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-gray-700">{{ $table->id }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('table.show', $table) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Openen
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection