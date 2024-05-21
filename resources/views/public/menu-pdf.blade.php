<div>
    @foreach($categories as $category)
        <div>
            <h3>{{ $category->name }}</h3>
            <ul>
                @foreach($category->products as $product)
                    <li>
                        <span>{{$product->display_number}}. {{$product->name}}</span>
                        <span></span>
                        <span>€ {{$product->price}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
