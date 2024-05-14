<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class AdminMenuController
{
    public function index()
    {
        return view('admin.menu.index', ['categories' => Category::with('products')->get()]);
    }

    public function create()
    {
        return view('admin.menu.create', ['categories' => Category::with('products')->get()]);
    }

    public function store(MenuRequest $request)
    {
        Product::create($request->toArray());
        Session::flash('success', 'Successvol menu aangemaakt!');
        return redirect()->route('admin.menu.index');
    }

    public function edit($menu)
    {
        $product = Product::find($menu);
        return view('admin.menu.edit', ['product' => $product, 'categories' => Category::with('products')->get()]);
    }

    public function update(MenuRequest $request, $menu)
    {
        Product::find($menu)->update($request->toArray());
        Session::flash('success', 'Successvol menu aangepast!');
        return redirect()->route('admin.menu.index');
    }

    public function destroy($menu)
    {
        Product::destroy($menu);
        Session::flash('success', 'Successvol menu verwijderd!');
        return redirect()->route('admin.menu.index');
    }
}
