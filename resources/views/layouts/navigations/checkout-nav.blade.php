<nav class="w-[20rem] h-screen bg-[#1f2937] text-white fixed z-50">
    <h1 class="w-full  border-b border-white/20 p-5 tracking-widest font-bold uppercase text-lg text-center text-white">
        De Gouden Draak
    </h1>
    <ul class="p-4 w-[90%] mx-auto">
        @if(Auth::user()->type == 'admin')
        <a href="{{route('admin.index')}}">
            <li class="p-2 rounded-lg cursor-pointer hover:bg-white/20"><i class="fa-solid fa-shield mr-2"></i>
                Admin Panel</li>
        </a>
        @endif

        <a href="{{route('checkout.index')}}">
            <li class="p-2 rounded-lg cursor-pointer hover:bg-white/20"><i class="fa-solid fa-shopping-cart mr-2"></i>
                Bestellingen</li>
        </a>
    </ul>
</nav>