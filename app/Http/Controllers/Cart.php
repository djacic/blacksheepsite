<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductToAssoc;
use Illuminate\Http\Request;

class Cart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get("refresh")) {
            $id = $request->get('item');
            $amount = $request->get('qnt');

            $items = session()->pull('orderItems');
            for($i = 0; $i < count($items); $i++) {
                if($items[$i]['item']->id == $id) {
                    $items[$i]['amount'] = $amount;
                }
            }
            session()->put('orderItems', $items);

        }

        $repo = Product::getRepository();
        return view('cart');
    }

    public function place(Request $request)
    {
        $id = $request->post('id');
        $product = Product::getRepository()->findById($id);

        if(!session('orderItems')) {
            session(['orderItems' => [
                [
                    'item' => $product,
                    'amount' => 1,
                    'type' => 'product'
                ]
            ]]);
        } else {
            $exists = false;
            $items = session()->pull('orderItems');
            for($i = 0; $i < count($items); $i++) {
                if($items[$i]['item']->id == $id) {
                    $items[$i]['amount']++;
                    $exists = true;
                }
            }
            session()->put('orderItems', $items);
            if(!$exists) {
                session()->push('orderItems',
                    [
                        'item' => $product,
                        'amount' => 1,
                        'type' => "product"
                    ]);
            }
        }
        return redirect()->back();
    }

    public function full(Request $request)
    {
        $id = $request->post('productId');
        $amount = $request->post('productQuantity');
        $colorId = $request->post('productColor');

        $product = \App\Product::find($id);
        if(!session('orderItems')) {
            session(['orderItems' => [
                [
                    'item' => $product,
                    'amount' => $amount,
                    'color_id' => $colorId,
                    'type' => "product"
                ]
            ]]);
        } else {
            $exists = false;
            $items = session()->pull('orderItems');
            for($i = 0; $i < count($items); $i++) {
                if($items[$i]['item']->id == $id) {
                    $items[$i]['amount']+=$amount;
                    $exists = true;
                }
            }
            session()->put('orderItems', $items);
            if(!$exists) {
                session()->push('orderItems',
                    [
                        'item' => $product,
                        'amount' => $amount,
                        'color_id' => $colorId,
                        'type' => "product"
                    ]);
            }
        }
        return redirect()->back();
    }


    public function remove($id)
    {
        $items = session()->get('orderItems');
        $newArray = [];
        for($i = 0; $i < count($items); $i++) {
            if($items[$i]['item']->id != $id) {
                array_push($newArray, $items[$i]);
            }
        }
        session()->put('orderItems', $newArray);
         return redirect()->back();
    }
}
