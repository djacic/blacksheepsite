<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\DTO\ProductDTO;
use App\Picture;
use App\Price;
use App\Product;
use App\ProductCategory;
use App\Repository\ProductRepository;
use App\Services\DTOValidator;
use App\Services\RequestToObject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getRepository()->exportAll();
        return [
            'products' => $products
        ];
    }

    public function store(Request $request)
    {
        $status = 422;
        $data = null;
        try {
            $dto = new ProductDTO();
            RequestToObject::transform($dto);
            $validator = new DTOValidator($dto);
            if($validator->isValid()) {
                $product = new Product();
                $product->brand_id = $dto->brand_id;
                $product->name = $dto->name;
                $product->picture_id = 24;
                $product->special = $dto->special;
                $product->is_offer = $dto->is_offer;
                $product->is_active = $dto->is_active;
                $product->type_id = $dto->type_id ? $dto->type_id : null;
                $product->description = $dto->description;
                $product->save();
                $product->colors()->sync(json_decode($dto->colors));
                $price = new Price();
                if($product->is_offer) {
                    $price->is_offer = true;
                }

                if($request->hasFile('picture')) {
                    $fileName = $request->file('picture')->getFilename() . "_" . mktime(time()) . "." . $request->file('picture')->extension();
                    Log::error($fileName);
                    $picture = new Picture();
                    $picture->alt = $product->name;
                    $picture->file = $fileName;
                    $picture->save();
					$request->file('picture')->move(base_path("/public/assets/pages/img/products/"), $fileName);
                    $product->picture_id = $picture->id;
                    $product->save();
                }

                $price->price = $dto->price;
                $price->product_id = $product->id;
                $price->save();
                $status = 201;
            } else {
                foreach($validator->getErrors() as $err) {
                    Log::error($err[0]);
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $status = 500;
        }
        return response($data, $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     //   Log::error($request->getContent());
        $status = 422;
        $data = null;
        try {
            $dto = new ProductDTO();
            RequestToObject::transform($dto);
            $validator = new DTOValidator($dto);
            if($validator->isValid()) {
                $product = Product::getRepository()->findById($id);
                $product->brand_id = $dto->brand_id;
                $product->name = $dto->name;

                if($request->hasFile('picture')){
                    $fileName = $request->file('picture')->getFilename() . "_" . mktime(time()) . "." . $request->file('picture')->extension();
                    Log::error($fileName);
                    $picture = new Picture();
                    $picture->alt = $product->name;
                    $picture->file = $fileName;
                    $picture->save();
                    $request->file('picture')->move(base_path("/public/assets/pages/img/products/"), $fileName);
                    $product->picture_id = $picture->id;
                    $product->save();
                }

                $product->special = $dto->special;
                $product->is_offer = $dto->is_offer;
                $product->is_active = $dto->is_active;
                $product->type_id = $dto->type_id ? $dto->type_id : null;
                $product->description = $dto->description;
                $product->save();
                $product->colors()->sync(json_decode($dto->colors));
                $price = new Price();
                if($product->is_offer) {
                    $price->is_offer = true;
                }
                $price->price = $dto->price;
                $price->product_id = $product->id;
                $price->save();

                $status = 201;
            } else {
                foreach($validator->getErrors() as $err) {
                    Log::error($err[0]);
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $status = 500;
        }
        return response($data, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::getRepository()->findById($id);
        if($product) {
            try {
                $product->is_active = false;
                $result = $product->save();
                return ['status' => 200];
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return ['status' => 500];
            }

        } else {
            return ['status' => 404];
        }

    }
}
