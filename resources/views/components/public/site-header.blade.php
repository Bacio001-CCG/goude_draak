
<div class="flex justify-between items-center flex-wrap w-full px-20">
    <div class="flex items-center">
        <img class="h-12" src="{{asset('img/dragon-small.png')}}" alt="">
        <span class="text-[#ffff00] text-3xl font-bold">{{ __('public.GoldenDragon') }}</span>
        <img class="h-12" src="{{asset('img/dragon-small-flipped.png')}}" alt="">
    </div>
    <div class="overflow-hidden whitespace-nowrap max-w-3xl">
        <div class="scrolling-text">
            <a href="#" class="text-[#ffff00]">{{ __('public.WelcomePressToSeeMore') }}</a>
        </div>
    </div>
    <div class="flex items-center">
        <img class="h-12" src="{{asset('img/dragon-small.png')}}" alt="">
        <span class="text-[#ffff00] text-3xl font-bold">{{ __('public.GoldenDragon') }}</span>
        <img class="h-12" src="{{asset('img/dragon-small-flipped.png')}}" alt="">       
    </div> 
    
    <div class="flex flex-row items-center right-1">
        <a href="" class="relative inline-flex items-center px-4 py-2 mr-2 text-sm font-medium text-[#ffff00] border border-[#ffff00] rounded-md hover:opacity-75 focus:outline-none">
            <span>EN</span>
            <span class="absolute top-0 right-0 -mt-0.5 -mr-1.5 bg-[#ffff00] rounded-full w-4 h-4 {{ App::getLocale() === 'en' ? 'block' : 'hidden' }}"></span>
        </a>

        <a href="" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#ffff00] border border-[#ffff00] rounded-md hover:opacity-75 focus:outline-none">
            <span>NL</span>
            <span class="absolute top-0 right-0 -mt-0.5 -mr-1.5 bg-[#ffff00] rounded-full w-4 h-4 {{ App::getLocale() === 'nl' ? 'block' : 'hidden' }}" ></span>
        </a>
    </div>    
</div>