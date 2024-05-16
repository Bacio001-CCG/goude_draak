<nav class="w-[20rem] h-screen fixed bg-[#1f2937] text-white">
    <h1 class="w-full  border-b border-white/20 p-5 tracking-widest font-bold uppercase text-lg text-center text-white">
        De Gouden Draak
    </h1>
    <ul class="p-4 w-[90%] mx-auto">
        <a href="{{route('checkout.index')}}">
            <li class="p-2 rounded-lg cursor-pointer hover:bg-white/20"><i class="fa-solid fa-cash-register mr-2"></i>
                Kassa Panel</li>
        </a>
        <a href="{{route('admin.menu.index')}}">
            <li class="p-2 rounded-lg cursor-pointer hover:bg-white/20"><i class="fa-solid fa-list mr-2"></i>
                Menu</li>
        </a>
        <a href="{{route('admin.schedule.index')}}">
            <li class="p-2 rounded-lg cursor-pointer hover:bg-white/20"><i class="fa-solid fa-calendar mr-2"></i>
                Agenda</li>
        </a>
    </ul>
</nav>