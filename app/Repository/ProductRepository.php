<?php
/**
 * Created by PhpStorm.
 * User: luka
 * Date: 10/21/2017
 * Time: 1:48 PM
 */

namespace App\Repository;


use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class ProductRepository extends AbstractRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function findById($id)
    {
        return $this->model->with([
            'picture',
            'prices' => function($query) {
                        $query->orderBy('created_at', 'desc');
            },
            'colors'
        ])->find($id);
    }

    public function all() {
       return $this->model->where("is_active", 1)->get();
   }
    public function allActive(){
      return $this->model->where('is_active',1)->get();
    }
    public function findAll()
   {
      return $this->model->with([
           'picture',
           'prices' => function($query) {
               $query->orderByDesc('created_at');
           },
           'colors'
       ])->where('is_active',1)->get();
   }

    public function exportAll()
    {
        return $this->model->with([
            'picture',
            'prices' => function($query) {
            $query->orderBy('created_at', 'desc');
            },
            'colors'
        ])->get();
    }

    public function search($keyword)
    {
        return $this->model->with([
            'picture',
            'prices' => function($query) {
                $query->orderBy('created_at', 'desc');
            },
            'colors'
        ])->where("name", "like", "%$keyword%")->where("is_active",1)->get();
    }
    public function latestProducts()
    {
        return $this->model->where('is_active', 1)->orderBy('id', "desc")->take(4)->get();
    }

    public function specialProducts()
    {
        return $this->model->where(['is_active' => 1, 'special' => 1])->orderBy('id', "desc")->take(5)->get();
    }


    public function productsOnSale()
    {
        return $this->model->where(
            [
                'is_active' => 1,
                'is_offer' => 1
            ])->get();
    }

}
