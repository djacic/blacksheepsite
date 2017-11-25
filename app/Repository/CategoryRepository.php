<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 28.10.17.
 * Time: 23.04
 */

namespace App\Repository;


use App\Category;
use App\ProductCategory;

class CategoryRepository extends AbstractRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function findByName($categoryName)
    {
        return $this->model->where('name','=',$categoryName)->get()[0];
    }

    public function allWithBrands()
    {
        return $this->model->with("brands")->get();
    }

    public function findAll()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }
}