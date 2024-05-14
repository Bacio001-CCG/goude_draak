@extends('layouts.admin-app')
@section('header')
Menu \ Aanmaken
@endsection
@section('content')

<form action="{{route('admin.menu.store')}}" method="POST">

    @csrf

    <div class="flex flex-col gap-5 max-w-[50rem] mx-auto">

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Weergave Nummer</label>
            <input type="text" name="display_number"
                class="w-full border rounded-lg p-1 @error('display_number') border-red-500 @enderror" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Naam</label>
            <input type="text" name="name"
                class="w-full border rounded-lg p-1 @error('name') border-red-500 @enderror" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Category</label>
            <select name="category_id"
                class="w-full border rounded-lg p-1 @error('category_id') border-red-500 @enderror">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Prijs</label>
            <input type="text" name="price"
                class="w-full border rounded-lg p-1 @error('price') border-red-500 @enderror" />
        </div>

        <button class=" bg-blue-500 text-white px-5 py-1 rounded-lg hover:bg-blue-500/50 w-[10rem]" type="submit">
            <i class="fa-solid fa-plus mr-1"></i> Aanmaken
        </button>

    </div>

</form>

@endsection