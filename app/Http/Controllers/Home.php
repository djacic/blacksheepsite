<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductToAssoc;
use Illuminate\Http\Request;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // session()->forget("orderItems");
        $repo = Product::getRepository();
        $latest = $repo->latestProducts();
        return view('index', [
            'data' => [
                'products' => $latest
            ]
        ]);
    }



}
