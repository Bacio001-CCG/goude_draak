@extends('layouts.admin-app')
@section('header')
Menu \ Lijst
@endsection
@section('content')

@session('success')
<div class="w-full p-3 border border-green-600 bg-green-400 mb-5">
    <p class="text-green > 500">{{session('success')}}</p>
</div>
@endsession

<menu-list :categories="{{$categories}}" />
@endsection