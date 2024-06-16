@extends('layouts.restaurant-app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Hulp vraag tafel: {{ $table->id }}</h2>

        <form action="{{ route('table.store.help', ['table' => $table->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Vraag</label>
                <textarea id="question" name="question" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="inline-block bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Vraag om hulp</button>
            </div>
        </form>
    </div>
@endsection
