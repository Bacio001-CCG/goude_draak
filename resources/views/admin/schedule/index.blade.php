@extends('layouts.admin-app')
@section('header')
Agenda
@endsection
@section('content')

<schedule :days="{{$days}}" :employees="{{$employees}}" :se="{{$selectedEmployees}}" :tables="{{$tables}}" />

@endsection