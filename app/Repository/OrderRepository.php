<?php
/**
 * Created by PhpStorm.
 * User: luke
 * Date: 5.11.17.
 * Time: 23.59
 */

namespace App\Repository;


use App\Order;

class OrderRepository extends AbstractRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function newOrders()
    {
        return $this->model->with(
            [
                'user',
                'products.picture',
                'products.prices' => function($query) {
                    $query->orderBy('created_at', 'desc')->first();
                },
            ])->get();
    }
}