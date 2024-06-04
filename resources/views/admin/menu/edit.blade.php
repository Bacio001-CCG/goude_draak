@extends('layouts.admin-app')
@section('header')
Menu \ Aanpassen
@endsection
@section('content')

<form action="{{route('admin.menu.update', ['menu' => $product->id])}}" method="POST">

    @method('PUT')
    @csrf

    <div class="flex flex-col gap-5 max-w-[50rem] mx-auto">

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Weergave Nummer</label>
            <input value="{{$product->display_number}}" type="text" name="display_number"
                class="w-full border rounded-lg p-1 @error('display_number') border-red-500 @enderror" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Naam</label>
            <input value="{{$product->name}}" type="text" name="name"
                class="w-full border rounded-lg p-1 @error('name') border-red-500 @enderror" />
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Category</label>
            <select value="{{$product->category_id}}" name="category_id"
                class="w-full border rounded-lg p-1 @error('category_id') border-red-500 @enderror">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label for="search" class="text-sm">Prijs</label>
            <input value="{{$product->price}}" type="number" name="price"
                class="w-full border rounded-lg p-1 @error('price') border-red-500 @enderror" />
        </div>

        <button class=" bg-blue-500 text-white px-5 py-1 rounded-lg hover:bg-blue-500/50 w-[10rem]" type="submit">
            <i class="fa-solid fa-pencil mr-1"></i> Aanpassen
        </button>

    </div>

</form>

<form action="{{route('admin.menu.destroy', ['menu' => $product->id])}}" method="POST">

    @method('DELETE')
    @csrf

    <div class="flex flex-col gap-5 max-w-[50rem] mx-auto mt-5">
        <button class=" bg-red-500 text-white px-5 py-1 rounded-lg hover:bg-blue-500/50 w-[10rem]" type="submit">
            <i class="fa-solid fa-trash mr-1"></i> Verwijderen
        </button>
    </div>

</form>

@endsection