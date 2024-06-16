@extends('components.public.site-border')

@section('main')
<div class="flex justify-between flex-wrap w-full mb-12">
    <img class="md:h-52 h-20 hidden md:block" src="{{asset('img/dragon-small.png')}}" alt="">
    <div class="text-center mx-auto ">
        <span class="text-[#ffff00] md:text-4xl font-bold">{{ __('public.ChineseIndianSpecialties') }}</span>
        <h1 class="text-[#ffff00] text-xl md:text-5xl font-bold">{{ __('public.GoldenDragon') }}</h1>

        <nav class="flex justify-center md:m-8 mx-auto">
            <ul class="flex space-x-0.5 border-[1px] border-black p-0.5">
                <li>
                    <a href="{{ route('menu.show') }}"
                        class="md:px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{ __('public.Menu')
                        }}</a>
                </li>
                <li>
                    <a href="/news" class="md:px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{
                        __('public.News') }}</a>
                </li>
                <li>
                    <a href="/contact" class="md:px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">{{
                        __('public.Contact') }}</a>
                </li>
            </ul>
        </nav>

    </div>
    <img class="md:h-52 h-20 hidden md:block" src="{{asset('img/dragon-small-flipped.png')}}" alt="">
</div>
<main class="md:px-12 mb-6">
    @yield('content')
</main>
<footer class="text-center">
    <a href="/contact" class="text-[#ffff00]">{{ __('public.ToContact') }}</a>
</footer>
@endsection