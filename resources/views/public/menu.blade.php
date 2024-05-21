@extends('layouts.public-app')

@section('content')
    <div class="bg-[#fffaf0] border-[1px] border-black text-center">
        <public-menu :categories="{{$categories}}"/>
    </div>
    <div class="text-center text-[#ffff00]">
        <a href="{{ route('menu.download') }}">Download menu</a>
    </div>
@endsection