<div class="flex flex-wrap justify-center text-left bg-[#edfabb]">
    @foreach($categories as $category)
        <div class="w-full md:w-1/1 lg:w-1/2 xl:w-1/3 p-4">
            <h3 class="text-center font-bold text-lg">{{ $category->name }}</h3>
            <ul>
                @foreach($category->products as $product)
                    <li class="flex justify-between">
                        <span>{{$product->display_number}}. {{$product->name}}</span>
                        <span class="flex-grow border-b border-black border-dotted mb-1"></span>
                        <span>€ {{$product->price}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
