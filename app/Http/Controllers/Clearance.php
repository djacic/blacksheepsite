<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductToAssoc;
use Illuminate\Http\Request;

class Clearance extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repo = Product::getRepository();
        $products = $repo->productsOnSale();

        return view('clearance', [
            'data' => [
                'products' => $products
            ]
        ]);
    }

}
