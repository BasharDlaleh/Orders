<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Models\Product::select('id', 'name')->get();
    }

}
