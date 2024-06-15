@extends('layouts.checkout-app')
@section('header')
Tafels
@endsection
@section('content')

<div class="flex flex-col gap-10">
    <div>
        <h2 class="font-bold text-2xl">Tafel {{ $table->id }}</h2>
    </div>

    <form action="{{ route('table.update', $table->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded p-4 mb-4">
            <div class="flex grid grid-cols-2">
                <div class="flex gap-5">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name_1">
                            Naam
                        </label>
                        <input name="names[]" required value="{{ old('name_1') }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name_1" type="text" placeholder="Naam">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth_1">
                            Geboortedatum
                        </label>
                        <input name="dates_of_birth[]" required value="{{ old('date_of_birth_1') }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_of_birth_1" type="date">
                    </div>
                </div>
            </div>

            <div class="flex">
                <button type="button" id="addButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Voeg Toe
                </button>
                <button type="button" id="removeButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:shadow-outline">
                    Verwijder
                </button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded p-4 mb-4 flex justify-between items-center">
            <div class="mb-4">
                <input name="deluxe_menu" class="mr-2 leading-tight" id="deluxe_menu" value="in" type="checkbox">
                <label class="text-gray-700 text-sm font-bold" for="deluxe_menu">
                    Deluxe Menu
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Tafel activeren 
                </button>
            </div>    
        </div>
    </form>
</div>

@endsection