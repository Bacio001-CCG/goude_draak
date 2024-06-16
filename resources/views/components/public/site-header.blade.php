<header class="flex justify-between items-center flex-wrap w-full md:px-20">
    <div class="flex items-center mx-auto xl:mx-0 ">
        <img class="h-12" src="{{asset('img/dragon-small.png')}}" alt="goude draak image">
        <span class="text-[#ffff00] text-xl md:text-3xl font-bold">{{ __('public.GoldenDragon') }}</span>
        <img class="h-12" src="{{asset('img/dragon-small-flipped.png')}}" alt="goude draak image">
    </div>
    <div class="overflow-hidden whitespace-nowrap max-w-3xl">
        <div class="scrolling-text">
            <a href="#" class="text-[#ffff00]">{{ __('public.WelcomePressToSeeMore') }}</a>
        </div>
    </div>
    <div class="items-center hidden xl:flex">
        <img alt="goude draak image" class="h-12" src="{{asset('img/dragon-small.png')}}">
        <span class="text-[#ffff00] text-3xl font-bold">{{ __('public.GoldenDragon') }}</span>
        <img alt="goude draak image" class="h-12" src="{{asset('img/dragon-small-flipped.png')}}">
    </div>
    <div class="absolute left-1/2 -translate-x-1/2 top-24 xl:top-16 z-50 flex">

        <form action="{{route('language.en')}}" method="POST">

            @csrf
            @method('POST')
            <button type="submit" title="Engelse Taal Knop"
                class="relative inline-flex items-center px-4 py-2 mr-2 text-sm font-medium bg-[#8B0000] text-[#ffff00] border border-[#ffff00] rounded-md hover:opacity-75 focus:outline-none">
                <span>EN</span>
                <span
                    class="absolute top-0 right-0 -mt-0.5 -mr-1.5 bg-[#ffff00] rounded-full w-4 h-4 {{ App::getLocale() === 'en' ? 'block' : 'hidden' }}"></span>
            </button>
        </form>

        <form action="{{route('language.nl')}}" method="POST">

            @csrf
            @method('POST')
            <button type="submit" title="Nederlands Taal Knop"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-[#8B0000] text-[#ffff00] border border-[#ffff00] rounded-md hover:opacity-75 focus:outline-none">
                <span>NL</span>
                <span
                    class="absolute top-0 right-0 -mt-0.5 -mr-1.5 bg-[#ffff00] rounded-full w-4 h-4 {{ App::getLocale() === 'nl' ? 'block' : 'hidden' }}"></span>
            </button>
        </form>
    </div>
</header>