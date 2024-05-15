<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class PublicMenuController
{
    public function show()
    {
        $categories = Category::has('products')
            ->with(['products' => function ($query) {
                $query->orderBy('display_number', 'asc');
            }])
            ->get();

        return view('public.menu', ['categories' => $categories]);        
    }
}
