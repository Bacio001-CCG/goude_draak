@extends('layouts.checkout-app')
@section('header')
Tafels
@endsection
@section('content')

<div>    
    <div>
        <h2 class="font-bold text-2xl">Tafel {{ $table->id }}</h2>
    </div>    
    <div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vraag</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actie</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($table->tableOrder->helpRequests as $helpRequest)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $helpRequest->question }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($helpRequest->completed)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Voltooid
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Open
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if (!$helpRequest->completed)
                                <a href="{{ route('table.complete.request', ['helpRequest' => $helpRequest->id]) }}" class="text-indigo-600 hover:text-indigo-900">Voltooien</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection