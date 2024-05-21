@extends('components.public.site-border')

@section('main')
    <div class="flex justify-between flex-wrap w-full mb-12">
        <img class="h-52" src="{{asset('img/dragon-small.png')}}" alt="">
        <div class="text-center">
            <span class="text-[#ffff00] text-4xl font-bold">{{ __('public.ChineseIndianSpecialties') }}</span>
            <h1 class="text-[#ffff00] text-5xl font-bold">{{ __('public.GoldenDragon') }}</h1>

            <nav class="flex justify-center m-8">
                <ul class="flex space-x-0.5 border-[1px] border-black p-0.5">
                    <li>
                        <a href="{{ route('menu.show') }}" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{ __('public.Menu') }}</a>
                    </li>
                    <li>
                        <a href="/news" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{ __('public.News') }}</a>
                    </li>
                    <li>
                        <a href="/contact" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{ __('public.Contact') }}</a>
                    </li>
                </ul>
            </nav>

        </div>
        <img class="h-52" src="{{asset('img/dragon-small-flipped.png')}}" alt="">       
    </div>
    <main class="px-12 mb-6">
        @yield('content')
    </main>
    <footer class="text-center">
        <a href="/contact" class="text-[#ffff00]">{{ __('public.ToContact') }}</a>
    </footer>
@endsection