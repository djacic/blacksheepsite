<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Repository\ProductRepository;
use App\Services\ProductToAssoc;
use App\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use PhpParser\Error;
class Products extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = Product::getRepository();
    }


    public function index(Request $request)
    {
        return view('products');
    }



    public function product($id)
    {
        return [Product::getRepository()->findById($id)];
    }

    public function get(Request $request) {
        $status = 200;
        $response = null;
        if (!$request->has('type')) {
            $status = 400;
            Log::error("Greska pri dohvatanju proizvoda sa stranice products. Nije prosledjen tip podataka za dohvatanje.");
        } else {
            switch ($request->get('type')) {
                case 'all':
                    $filteredData = $this->filterProducts($request, Product::getRepository()->allActive());
                    $response['products'] = $filteredData['products'];
                    $response['pages'] = $filteredData['pagesNum'];
                    $response['categories'] = Category::getRepository()->findAll();
                    break;
                case 'category':
                    try {
                        $category = Category::getRepository()->findById($request->get('categoryId'));
                        if ($category) {
                            $brands = $category->brands;
                            $productsCollection = new Collection();
                            foreach ($brands as $brand) {
                                foreach ($brand->products as $product) {
                                    $productsCollection->add($product);
                                }
                            }
                            $filteredData = $this->filterProducts($request, $productsCollection);
                            $response['products'] = $filteredData['products'];
                            $response['brands'] = $brands;
                            $response['pages'] = $filteredData['pagesNum'];
                        }
                    } catch (\Exception $e) {
                        $status = 500;
                        Log::error($e->getMessage());
                    }
                    break;
                case 'brand':
                    $brandIds = $request->get("brandIds");
                    try {
                        $productsCollection = new Collection();
                        $typesCollection = new Collection();
                        foreach ($brandIds as $id) {
                            $brand = Brand::getRepository()->findById($id);
                            foreach ($brand->products as $product) {
                                $productsCollection->add($product);
                            }
                        }
                        foreach ($productsCollection as $product) {
                            if($product->type) {
                                $typesCollection->add($product->type);
                            }
                        }
                        $filteredData = $this->filterProducts($request, $productsCollection);
                        $response['products'] = $filteredData['products'];
                        $response['pages'] = $filteredData['pagesNum'];
                        $response['types'] = $typesCollection->unique();
                    } catch (\Exception $e) {
                        $status = 500;
                        Log::error($e->getMessage());
                    }
                    break;
                case 'type':
                    try {
                        $typeIds = $request->get("typeIds");
                        $brandIds = $request->get("brandIds");
                        $productsCollection = new Collection();
                        foreach ($typeIds as $id) {
                            $type = Type::getRepository()->findById($id);
                            foreach ($type->products as $product) {
                                if(in_array($product->brand_id, $brandIds)) {
                                    $productsCollection->add($product);
                                }
                            }
                        }
                        $filteredData = $this->filterProducts($request, $productsCollection);
                        $response['products'] = $filteredData['products'];
                        $response['pages'] = $filteredData['pagesNum'];
                    } catch (\Exception $e) {
                        $status = 500;
                        Log::error($e->getMessage());
                    }
                    break;
            }
        }
        return response($response,$status);
    }

    private function getPagesNum(Collection $collection) {
        return ceil($collection->count()/12);
    }

    /*
        Filtrira proizvode na osnovu request-a
    */
    private function filterProducts(Request $request, Collection $products) {

        if($request->has('order')) {
            switch ($request->get("order")) {
                case "date_asc":
                    $products = $products->sortBy(function($product){
                        return $product->created_at;
                    });
                    break;
                case "date_desc":
                    $products = $products->sortByDesc(function($product){
                        return $product->created_at;
                    });
                    break;
                case "price_asc":
                    $products = $products->sortBy(function($product) {
                        return $product->prices->first()['price'];
                    });
                    break;
                case "price_desc":
                    $products = $products->sortByDesc(function($product) {
                        return $product->prices->first()['price'];
                    });
                    break;
                case "name_asc":
                    $products = $products->sortBy(function($product){
                        return explode(" ", $product->name)[0];
                    });
                    break;
                case "name_desc":
                    $products = $products->sortByDesc(function($product){
                        return explode(" ", $product->name)[0];
                    });
                    break;
            }
        }
        function match_all($needles, $haystack)
        {
            foreach($needles as $needle) {
                if (strpos(strtolower($haystack), strtolower($needle)) == false) {
                    return false;
                }
            }
            return true;
        }
        $page = $request->get('page') ? $request->get('page') : 1;
        $keyword = $request->has('keyword') ? $request->get('keyword') : null;
        if ($keyword) {

            $filtered = $products->filter(function ($value) use ($keyword){
            $needles = explode(" ", $keyword);
            $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'č'=>'c', 'ć'=>'c', 'Č'=>'C', 'Ć'=>'C');
            $haystack = $value->name;
            $haystack2 = strtr(strtolower($value->name), $unwanted_array );

            return  match_all($needles, $haystack) !== false || match_all($needles,$haystack2) !== false;


            });
            $pagesNum = $this->getPagesNum($filtered);
            $result = $filtered->forPage($page, 12);
        } else {
            $pagesNum = $this->getPagesNum($products);
            $result = $products->forPage($page, 12);
        }

        $collection = [];
        foreach ($result as $product) {
            $item = new \stdClass();
            $item->id = $product->id;
            $item->name = $product->name;
            $item->is_offer = $product->is_offer;
            $item->is_active = $product->is_active;
            $item->price = $product->prices()->latest()->first()['price'];//first()['price'];
            $item->picture = $product->picture;
            array_push($collection, $item);

        }
        return [
            'products' => $collection,
            'pagesNum' => $pagesNum
        ];
    }





}
