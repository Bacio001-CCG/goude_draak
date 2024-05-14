<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-gray-100">

    <div id="app" class="flex">
        @include('layouts.navigations.admin-nav')
        <div class="w-full ml-[20rem]">
            <div
                class="w-full bg-white text-black/50 border-b p-5 tracking-widest font-bold uppercase text-lg relative">
                <h1>Admin \ <span class="text-base">@yield('header')</span></h1>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="fa-solid fa-right-from-bracket absolute right-5 top-1/2 -translate-y-1/2"
                        type="submit"></button>
                </form>
            </div>
            <div class="p-5">
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>