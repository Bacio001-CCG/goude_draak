
@extends('layouts.restaurant-app')

@section('content')
    <div>
        <div>
            <h2 class="font-bold text-2xl">Bedanktvoor uw bezoek!</h2>
        </div>        
        <div>
            <p class="mb-5">Laat een review achter!</p>
            <div class="flex justify-center">
                <a href="{{$url}}">
                    {{ $qrCode }}
                </a>
            </div>     
        </div>     
    </div>
@endsection