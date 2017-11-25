<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 30.10.17.
 * Time: 00.06
 */

namespace App\Services;


use App\Product;

class ProductToAssoc
{
    public static function convert($products)
    {
            $array  = [];
            foreach($products as $product) {
                $item = [
                    'picture' => [
                        'alt' => isset($product->pictures[0]->alt) ? $product->pictures[0]->alt : "",
                        'file' => isset($product->pictures[0]->file) ? $product->pictures[0]->file : ""
                    ],
                    'name' => $product->name,
                    'price' => $product->prices[0]->price,
                    'id' => $product->id,
                    'is_offer' => $product->is_offer
                ];
                array_push($array, $item);
            }
            return $array;
    }

    public static function convertOne(Product $product)
    {
        return [
            'name' => $product->name,
            'picture' => [
                'alt' => isset($product->pictures[0]->alt) ? $product->pictures[0]->alt : "",
                'file' => isset($product->pictures[0]->file) ? $product->pictures[0]->file : ""
            ],
            'price' => $product->prices[0]->price,
            'id' => $product->id,
            'is_offer' => $product->is_offer,
            'description' => $product->description,
            'colors' => $product->colors
        ];
    }
}