@extends('components.public.site-border')

@section('main')
    <div class="flex justify-between flex-wrap w-full mb-12">
        <img class="h-52" src="{{asset('img/dragon-small.png')}}" alt="">
        <div class="text-center">
            <h1 class="text-[#ffff00] text-4xl font-bold"><!-- {{ __('ChineseIndianSpecialties') }} -->Chinees Indische Specialiteiten</h1>
            <span class="text-[#ffff00] text-5xl font-bold"><!-- {{ __('GoldenDragon') }} -->De Gouden Draak</span>

            <nav class="flex justify-center m-8">
                <ul class="flex space-x-0.5 border-[1px] border-black p-0.5">
                    <li>
                        <a href="/" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">Menukaart</a>
                    </li>
                    <li>
                        <a href="/" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">Nieuws</a>
                    </li>
                    <li>
                        <a href="/" class="px-8 text-white bg-gradient-to-b from-[#00F9FF] to-blue-700">Contact</a>
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
        <a href="/" class="text-[#ffff00]">Naar contact</a>
    </footer>
@endsection