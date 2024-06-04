<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Category;

class TableController
{
    public function show(Table $table)
    {        
        $categories = Category::has('products')
            ->with(['products' => function ($query) {
                $query->orderBy('display_number', 'asc');
            }])
            ->get();

        return view('restaurants.table.show', ['table' => $table, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        foreach($request->order as $productId => $quantity) {
            if($quantity > 0)
            {
                
            }
        }
        return response()->json(['message' => 'Order submitted successfully'], 200);
    }
}
