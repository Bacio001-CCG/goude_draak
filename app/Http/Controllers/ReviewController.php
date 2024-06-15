<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public.review');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Review::create([
            'email' => $request[0],
            'review' => $request[1],
            'rating' => $request[2],
            'speedRating' => $request[3],
        ]);
        return response()->json([], 200);
    }
}
