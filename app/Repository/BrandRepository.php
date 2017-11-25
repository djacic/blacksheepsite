<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 5.11.17.
 * Time: 23.40
 */

namespace App\Repository;


use App\Brand;

class BrandRepository extends AbstractRepository
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function findAll()
    {
        return $this->model->orderBy('name', 'ASC')->get();
    }

}
