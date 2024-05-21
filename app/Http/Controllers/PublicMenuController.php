<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    public function addFav()
    {
        // add favroute to cache     
    }

    public function downloadMenuPdf()
    {
        $dompdf = new Dompdf();

        $categories = Category::has('products')
            ->with(['products' => function ($query) {
                $query->orderBy('display_number', 'asc');
            }])
            ->get();
        
        $html = view('public.menu-pdf', ['categories' => $categories])->render();
        
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        
        $dompdf->render();
        
        return $dompdf->stream('menu.pdf');
    }
}
